<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Repository;

use App\Common\Gateway\GatewayInterface;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Entity\TaskInterface;

/**
 * Class TaskRepository.
 */
class TaskRepository
{
    /**
     * @var TaskFactory
     */
    private $factory;

    /**
     * @var GatewayInterface
     */
    private $gateway;

    /**
     * TaskRepository constructor.
     *
     * @param TaskFactory $factory
     * @param GatewayInterface $gateway
     */
    public function __construct(TaskFactory $factory, GatewayInterface $gateway)
    {
        $this->factory = $factory;
        $this->gateway = $gateway;
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->gateway->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param $description
     * @param int $progress
     * @return \App\Tasks\Entity\TaskInterface
     */
    public function nextIdentity($description, $progress = 0)
    {
        return $this->factory->make(null, $description, $progress);
    }

    /**
     * @param TaskInterface $task
     * @return TaskInterface
     */
    public function save(TaskInterface $task)
    {
        $this->gateway->save($task);

        return $task;
    }

    /**
     * @param TaskInterface $task
     * @param string $description
     * @return TaskInterface
     */
    public function saveDescription(TaskInterface $task, $description)
    {
        $task = $this->factory->make(
            $task->id(),
            $description,
            $task->getProgress()->get()
        );

        $this->gateway->save($task);

        return $task;
    }

    /**
     * @param TaskInterface $task
     * @param int $progress
     * @return TaskInterface
     */
    public function saveProgress(TaskInterface $task, $progress)
    {
        $task = $this->factory->make(
            $task->id(),
            $task->getDescription(),
            $progress
        );


        $this->gateway->save($task);

        return $task;
    }

}
