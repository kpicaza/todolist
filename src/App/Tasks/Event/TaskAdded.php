<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Event;

use App\Tasks\Entity\TaskInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class TaskAdded
 * @package App\Tasks\Event
 */
class TaskAdded extends Event
{
    /**
     * @var TaskInterface
     */
    private $task;

    /**
     * @var \DateTimeInterface
     */
    private $receivedAt;

    /**
     * TaskAdded constructor.
     * @param TaskInterface $task
     * @param \DateTimeInterface $receivedAt
     */
    public function __construct(TaskInterface $task, \DateTimeInterface $receivedAt)
    {
        $this->task = $task;
        $this->receivedAt = $receivedAt;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Events::ADD_TASK;
    }

    /**
     * @return TaskInterface
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReceivedAt()
    {
        return $this->receivedAt;
    }
}
