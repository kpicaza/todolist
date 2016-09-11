<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Entity;

use App\Common\Entity\Progress;
use App\Users\Entity\UserId;
use Ramsey\Uuid\Uuid;

/**
 * Class TaskFactory
 * @package App\Tasks\Entity
 */
class TaskFactory
{
    /**
     * Create Tasks.
     *
     * @param $taskId
     * @param $name
     * @param int $progress
     *
     * @return Task
     */
    public function make($taskId, $userId, $name, $progress = 0)
    {
        $taskId = new TaskId($taskId ?: Uuid::uuid4());

        $userId = is_string($userId) ? new UserId($userId) : $userId;

        return new Task($taskId, $userId, new Progress($progress), $name);
    }
}
