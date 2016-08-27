<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\EventListener;

/**
 * Class TaskPersistedListener.
 */
class TaskPersistedListener
{
    /**
     * @return bool
     */
    public function onTaskPersisted()
    {
        return true;
    }
}
