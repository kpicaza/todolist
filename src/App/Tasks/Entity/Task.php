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
class Task implements TaskInterface, \JsonSerializable
{
    /**
     * Task unique identifier.
     * @var TaskId
     */
    private $id;

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
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface
     */
    private $updatedAt;

    /**
     * Task constructor.
     * @param TaskId $taskId
     * @param ProgressInterface $progress
     * @param $description
     */
    public function __construct(TaskId $taskId, ProgressInterface $progress, $description)
    {
        $this->id = $taskId;
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
        return (string) $this->id;
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

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     *
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     *
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * {inheritdoc}
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => (string) $this->id,
            'description' => $this->description,
            'progress' => $this->progress,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }
}
