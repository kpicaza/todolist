<?php

namespace App\Tasks\Controller;

use App\Tasks\Repository\TaskRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PatchController
 * @package App\Tasks\Controller
 */
class PatchController
{
    const VALID_COMMANdS = [
        'saveDescription',
        'saveProgress'
    ];

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * TaskController constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param TaskRepository $repository
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, TaskRepository $repository)
    {
        $this->dispatcher = $eventDispatcher;
        $this->repository = $repository;
    }

    public function patchAction(Request $request, $id)
    {
        $data = $request->request->all();

        try {
            if (!array_key_exists('replace', $data)) {
                throw new \InvalidArgumentException(
                    'replace command cannot be empty.'
                );
            }

            $command = sprintf('save%s', ucfirst($data['replace']));

            if (!in_array($command, self::VALID_COMMANdS, true)) {
                throw new \InvalidArgumentException(
                    'replace command must be one of .' . implode(',', self::VALID_COMMANdS)
                );
            }

            if (!array_key_exists('value', $data)) {
                throw new \InvalidArgumentException(
                    'replace command value cannot be empty.'
                );
            }

            $tasks = $this->repository->findBy(['id' => $id]);


            if (!$tasks) {
                throw new \InvalidArgumentException(
                    'Id must have valid Task id.'
                );
            }

            $this->repository->$command($tasks[0], $data['value']);

        } catch (\InvalidArgumentException $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse('', Response::HTTP_ACCEPTED);
    }
}
