<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\EventListener;

/**
 * Class TaskPersistedListener
 * @package App\Tasks\EventListener
 */
class TaskPersistedListener
{
    /**
     * Task  added Event Listener.
     *
     * @return bool
     */
    public function onTaskPersisted()
    {
        return true;
    }
}
