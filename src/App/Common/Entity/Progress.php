<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Common\Entity;

/**
 * Class Progress.
 */
class Progress implements ProgressInterface, \JsonSerializable
{
    /**
     * Progress.
     *
     * @var int
     */
    private $progress;

    /**
     * Progress constructor.
     *
     * @param $progress
     */
    public function __construct($progress)
    {
        if (!is_int($progress) || 0 > $progress || 100 < $progress) {
            throw new \InvalidArgumentException(
                'Progress should be an integer between 0 and 100.'
            );
        }

        $this->progress = $progress;
    }

    /**
     * Check if progress is complete or not.
     *
     * @return bool
     */
    public function isDone()
    {
        return 100 === $this->progress;
    }

    /**
     * Get progress count.
     *
     * @return int
     */
    public function get()
    {
        return $this->progress;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'progress' => $this->progress,
            'isDone' => $this->isDone(),
        ];
    }
}
