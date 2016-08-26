<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Common\Entity;

/**
 * Class Progress
 * @package App\Common\Entity
 */
class Progress implements ProgressInterface
{
    /**
     * Progress.
     * @var int
     */
    private $progress;

    /**
     * Progress constructor.
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
     * @return bool
     */
    public function isDone()
    {
        return 100 === $this->progress;
    }

    /**
     * Get progress count.
     * @return int
     */
    public function get()
    {
        return $this->progress;
    }
}
