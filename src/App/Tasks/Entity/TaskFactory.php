<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Entity;

use App\Common\Entity\Progress;
use Ramsey\Uuid\Uuid;

/**
 * Class TaskFactory
 * @package App\Tasks\Entity
 */
class TaskFactory
{
    /**
     * @param $name
     * @param int $progress
     * @return Task
     */
    public function make($name, $progress = 0)
    {
        $taskId = new TaskId(Uuid::uuid4());

        return new Task($taskId, new Progress($progress), $name);
    }
}
