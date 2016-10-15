<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Controller;

use App\Tasks\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetController.
 */
class GetController
{
    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * GetController constructor.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get a Task.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function getAction(Request $request, $id)
    {
        $tasks = $this->repository->findBy(['id' => $id]);

        if (!$tasks) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($tasks[0], Response::HTTP_OK);
    }
}
