<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Controller;

use App\Tasks\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DeleteController
 * @package App\Tasks\Controller
 */
class DeleteController
{
    /**
     * Task repository.
     *
     * @var TaskRepository
     */
    private $repository;

    /**
     * DeleteController constructor.
     *
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete a Task.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function deleteAction(Request $request, $id)
    {
        try {

            if (false === $this->repository->delete($id)) {
                throw new \InvalidArgumentException();
            }

        } catch (\InvalidArgumentException $e) {
            return new JsonResponse('', 404);
        }

        return new JsonResponse('', 204);
    }
}
