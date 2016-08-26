<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Common\Entity;

/**
 * Interface ProgressInterface
 * @package App\Common\Entity
 */
interface ProgressInterface
{
    /**
     * Check if progress is complete or not.
     * @return mixed
     */
    public function isDone();

    /**
     * Get progress count.
     * @return mixed
     */
    public function get();
}
