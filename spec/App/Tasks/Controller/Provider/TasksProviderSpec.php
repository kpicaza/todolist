<?php

namespace spec\App\Tasks\Controller\Provider;

use App\Tasks\Controller\Provider\TasksProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Silex\Application;

class TasksProviderSpec extends ObjectBehavior
{
    function it_should_connect()
    {
        $app = new Application();

        $this->connect($app);

        $this->shouldHaveType(TasksProvider::class);
    }
}
