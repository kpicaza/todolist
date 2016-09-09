<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Repository;

use App\Common\Gateway\GatewayInterface;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Entity\TaskInterface;

/**
 * Class TaskRepository
 * @package App\Tasks\Repository
 */
class TaskRepository
{
    /**
     * Task factory.
     *
     * @var TaskFactory
     */
    private $factory;

    /**
     * Task gateway.
     *
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
     * Find list of Tasks.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     *
     * @return mixed
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->gateway->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Get next new Task.
     *
     * @param $description
     * @param int $progress
     *
     * @return \App\Tasks\Entity\TaskInterface
     */
    public function nextIdentity($description, $progress = 0)
    {
        return $this->factory->make(null, $description, $progress);
    }

    /**
     * Persist new Task.
     *
     * @param TaskInterface $task
     *
     * @return TaskInterface
     */
    public function save(TaskInterface $task)
    {
        $this->gateway->save($task);

        return $task;
    }

    /**
     * Save Task description.
     *
     * @param TaskInterface $task
     * @param string $description
     *
     * @return TaskInterface
     */
    public function saveDescription(TaskInterface $task, $description)
    {
        $progress = $task->getProgress();

        $task = $this->factory->make(
            $task->id(),
            $description,
            $progress->get()
        );

        $this->gateway->update($task);

        return $task;
    }

    /**
     * Save Task progress.
     *
     * @param TaskInterface $task
     * @param int $progress
     *
     * @return TaskInterface
     */
    public function saveProgress(TaskInterface $task, $progress)
    {
        $task = $this->factory->make(
            $task->id(),
            $task->getDescription(),
            (int)$progress
        );


        $this->gateway->update($task);

        return $task;
    }

}
