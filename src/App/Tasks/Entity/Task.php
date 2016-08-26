<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Entity;

use App\Common\Entity\ProgressInterface;

/**
 * Class Task
 * @package App\Tasks\Entity
 */
class Task implements TaskInterface
{
    /**
     * Task unique identifier.
     * @var TaskId
     */
    private $taskId;

    /**
     * Progress.
     * @var ProgressInterface
     */
    private $progress;

    /**
     * Description
     * @var string
     */
    private $description;

    /**
     * Task constructor.
     * @param TaskId $taskId
     * @param ProgressInterface $progress
     * @param $description
     */
    public function __construct(TaskId $taskId, ProgressInterface $progress, $description)
    {
        $this->taskId = $taskId;
        $this->progress = $progress;

        if (empty($description)) {
            throw new \InvalidArgumentException(
                'Description cannot be empty.'
            );
        }

        $this->description = $description;
    }

    /**
     * Task id.
     * @return string
     */
    public function id()
    {
        return (string) $this->taskId;
    }

    /**
     * Get Task Progress count.
     * @return ProgressInterface
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Get Task Description.
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
