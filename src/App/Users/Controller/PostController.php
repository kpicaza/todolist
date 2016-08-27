<?php

namespace App\Users\Controller;

use App\Users\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * TaskController constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param UserRepository           $repository
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, UserRepository $repository)
    {
        $this->dispatcher = $eventDispatcher;
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function postAction(Request $request)
    {
        $data = $request->request->all();

        try {
            $required = ['username', 'email', 'password'];



            if (!array_key_exists('username', $data)) {
                throw new \InvalidArgumentException(
                    'Username cannot be empty.'
                );
            }
            if (!array_key_exists('email', $data)) {
                throw new \InvalidArgumentException(
                    'Email cannot be empty.'
                );
            }
            if (!array_key_exists('password', $data)) {
                throw new \InvalidArgumentException(
                    'Password cannot be empty.'
                );
            }

            $user = $this->repository->insert(
                $data['username'],
                $data['email'],
                $data['password']
            );
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);    }
}
