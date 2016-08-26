<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Repository;

use App\Common\Gateway\GatewayInterface;
use App\Tasks\Entity\TaskFactory;

/**
 * Class TaskRepository
 * @package App\Tasks\Repository
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
     * @param TaskFactory $factory
     * @param GatewayInterface $gateway
     */
    public function __construct(TaskFactory $factory, GatewayInterface $gateway)
    {
        $this->factory = $factory;
        $this->gateway = $gateway;
    }

    /**
     * @param string $description
     * @param int $progress
     * @return \App\Tasks\Entity\TaskInterface
     */
    public function insert($description, $progress = 0)
    {
        $task = $this->factory->make($description, $progress);

        $this->gateway->save($task);

        return $task;
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->gateway->findBy($criteria, $orderBy, $limit, $offset);
    }
}
