<?php

namespace spec\App\Tasks\Gateway;

use App\Tasks\Entity\TaskFactory;
use App\Tasks\Gateway\TaskGateway;
use App\Users\Entity\UserId;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;

class TaskGatewaySpec extends ObjectBehavior
{
    private $prophet;

    function let()
    {
        $this->prophet = new Prophet();
    }

    function it_can_save_objects_on_persistence_layer()
    {
        $this->beConstructedWith(
            $this->prophet->prophesize(EntityManager::class)->reveal(),
            new \Doctrine\ORM\Mapping\ClassMetadata(\App\Tasks\Entity\Task::class)
        );

        $task = (new TaskFactory())->make(null, UserId::fromString(Uuid::uuid4()), 'hola mundo');

        $this->save($task)->shouldBe($task);
    }
}
