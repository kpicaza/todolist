<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Entity;

/**
 * Interface TaskInterface.
 */
interface TaskInterface
{
    /**
     * Task id.
     *
     * @return mixed
     */
    public function id();

    /**
     * Get Task Progress count.
     *
     * @return mixed
     */
    public function getProgress();

    /**
     * Get Task Description.
     *
     * @return mixed
     */
    public function getDescription();
}
