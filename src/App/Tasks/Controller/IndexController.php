<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Controller;

use App\Tasks\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController.
 */
class IndexController
{
    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * IndexController constructor.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return JsonResponse
     */
    public function getAction()
    {
        $tasks = $this->repository->findBy([]);

        return new JsonResponse($tasks, Response::HTTP_OK);
    }
}
