<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Event;

use App\Tasks\Entity\TaskInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class TaskAdded.
 */
class TaskAdded extends Event
{
    /**
     * A Task.
     *
     * @var TaskInterface
     */
    private $task;

    /**
     * Event received at datetime.
     *
     * @var \DateTimeInterface
     */
    private $receivedAt;

    /**
     * TaskAdded constructor.
     *
     * @param TaskInterface      $task
     * @param \DateTimeInterface $receivedAt
     */
    public function __construct(TaskInterface $task, \DateTimeInterface $receivedAt)
    {
        $this->task = $task;
        $this->receivedAt = $receivedAt;
    }

    /**
     * Get Event name.
     *
     * @return string
     */
    public function getName()
    {
        return Events::ADD_TASK;
    }

    /**
     * Get Task.
     *
     * @return TaskInterface
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Get Event received at datetime.
     *
     * @return \DateTimeInterface
     */
    public function getReceivedAt()
    {
        return $this->receivedAt;
    }
}
