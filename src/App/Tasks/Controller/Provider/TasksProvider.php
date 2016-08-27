<?php

/**
 * This file is part of the InCrm package.
 */

namespace App\Tasks\Controller\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

/**
 * Class OrganizationProvider
 * @package InCRM\App\Controller\Provider
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
