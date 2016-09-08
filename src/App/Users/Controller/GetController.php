<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Controller;

use App\Users\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * User PostController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction(Request $request, $id)
    {
        try {
            $user = $this->repository->findOneBy(['id' => $id]);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($user, Response::HTTP_OK);
    }
}
