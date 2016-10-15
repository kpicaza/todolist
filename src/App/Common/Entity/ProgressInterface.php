<?php

/**
 * This file is part of TodoList\Common package.
 */

namespace App\Common\Entity;

/**
 * Interface ProgressInterface.
 */
interface ProgressInterface
{
    /**
     * Check if progress is complete or not.
     *
     * @return mixed
     */
    public function isDone();

    /**
     * Get progress count.
     *
     * @return mixed
     */
    public function get();
}
