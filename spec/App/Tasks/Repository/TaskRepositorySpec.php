<?php

namespace spec\App\Tasks\Repository;

use App\Tasks\Entity\Task;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Gateway\TaskGateway;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Prophet;
use Tests\Gateway\FakeGateway;

class TaskRepositorySpec extends ObjectBehavior
{
    const NAME = 'todolist.task.added';
    const PROGRESS = 56;

    private $prophet;

    function let()
    {
        $this->prophet = new Prophet();
    }

    function it_should_persist_new_tasks()
    {
        $gateway = new FakeGateway();
        $factory = new TaskFactory();

        $task = $factory->make(self::NAME, self::PROGRESS);


        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeTask = $this->insert(self::NAME, self::PROGRESS);
        $fakeTask->getDescription()->shouldBe($task->getDescription());
        $fakeTask->getProgress()->get()->shouldBe($task->getProgress()->get());
    }

    function it_can_obtain_a_list_of_items()
    {
        $factory = new TaskFactory();

        $task = $factory->make(self::NAME, self::PROGRESS);

        $gateway = $this->prophet->prophesize(TaskGateway::class);
        $gateway
            ->findBy([], null, null, null)
            ->willReturn([$task]);

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $this->findBy([])->shouldBe([$task]);
    }
}
