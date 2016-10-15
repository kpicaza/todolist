<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Controller;

use App\Tasks\Event\TaskAdded;
use App\Tasks\Event\Events;
use App\Tasks\Repository\TaskRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class PostController.
 */
class PostController
{
    /**
     * Event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * Task repository.
     *
     * @var TaskRepository
     */
    private $repository;

    /**
     * Post-Authentication Token.
     *
     * @var PostAuthenticationGuardToken
     */
    private $security;

    /**
     * TaskController constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param TaskRepository           $repository
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        TaskRepository $repository,
        PostAuthenticationGuardToken $security
    ) {
        $this->dispatcher = $eventDispatcher;
        $this->repository = $repository;
        $this->security = $security;
    }

    /**
     * Create new Task.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function postAction(Request $request)
    {
        $data = $request->request->all();

        try {
            if (!array_key_exists('description', $data)) {
                throw new \InvalidArgumentException(
                    'Description cannot be empty.'
                );
            }

            $task = $this->repository->save(
                $this->repository->nextIdentity(
                    $this->security->getUser()->id(),
                    $data['description'],
                    array_key_exists('progress', $data) ? $data['progress'] : 0
                )
            );

            $this->dispatcher->dispatch(
                Events::ADD_TASK,
                new TaskAdded($task, new \DateTime())
            );
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse('', Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse('', Response::HTTP_NO_CONTENT);
    }
}
