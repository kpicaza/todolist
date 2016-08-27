<?php

/**
 * This file is part of TodoList\tasks package.
 */

namespace App\Tasks\Controller\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

/**
 * Class OrganizationProvider.
 */
class TasksProvider implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $task = $app['controllers_factory'];

        $task->get('/', 'tasks.index.controller:getAction');
        $task->post('/', 'tasks.post.controller:postAction');
        $task->get('/{id}', 'tasks.get.controller:getAction');

        return $task;
    }
}
