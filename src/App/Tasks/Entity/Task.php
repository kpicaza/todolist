<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Entity;

use App\Common\Entity\AggregateRoot;
use App\Common\Entity\ProgressInterface;
use App\Users\Entity\User;
use App\Users\Entity\UserId;

/**
 * Class Task
 * @package App\Tasks\Entity
 */
class Task extends AggregateRoot implements TaskInterface
{
    /**
     * Task unique identifier.
     *
     * @var TaskId
     */
    private $id;

    /**
     * Progress.
     *
     * @var ProgressInterface
     */
    private $progress;

    /**
     * Description.
     *
     * @var string
     */
    private $description;

    /**
     * Task Author Id.
     *
     * @var UserId
     */
    private $authorId;

    /**
     * Created at.
     *
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * Updated at.
     *
     * @var \DateTimeInterface
     */
    private $updatedAt;

    /**
     * Task constructor.
     *
     * @param TaskId $taskId
     * @param UserId $authorId
     * @param ProgressInterface $progress
     * @param $description
     */
    public function __construct(TaskId $taskId, UserId $authorId, ProgressInterface $progress, $description)
    {
        $this->id = $taskId;
        $this->authorId = $authorId;
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
     *
     * @return string
     */
    public function id()
    {
        return (string) $this->id;
    }

    /**
     * Get Author id
     *
     * @return string
     */
    public function authorId()
    {
        return (string) $this->authorId;
    }

    /**
     * Get Task Progress count.
     *
     * @return ProgressInterface
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Get Task Description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {inheritdoc}.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => (string) $this->id,
            'authorId' => (string) $this->authorId,
            'description' => $this->description,
            'progress' => $this->progress,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
