<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Controller;

use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationFactoryInterface;
use App\Users\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * User Repository.
     *
     * @var UserRepository
     */
    private $repository;

    /**
     * Organization Factory.
     *
     * @var OrganizationFactoryInterface
     */
    private $organizationFactory;

    /**
     * PostController constructor.
     *
     * @param EventDispatcherInterface     $eventDispatcher
     * @param UserRepository               $repository
     * @param OrganizationFactoryInterface $organizationFactory
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        UserRepository $repository,
        OrganizationFactoryInterface $organizationFactory
    ) {
        $this->dispatcher = $eventDispatcher;
        $this->repository = $repository;
        $this->organizationFactory = $organizationFactory;
    }

    /**
     * Create new user.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function postAction(Request $request)
    {
        $data = $request->request->all();

        try {
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

            if (!array_key_exists('organization', $data)) {
                throw new \InvalidArgumentException(
                    'Organization cannot be empty.'
                );
            }

            $user = $this->repository->nextIdentity(
                $this->organizationFactory->make(null, $data['organization']),
                $data['username'],
                $data['email'],
                $data['password']
            );

            $this->repository->save($user);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
