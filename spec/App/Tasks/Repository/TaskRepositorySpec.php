<?php

namespace spec\App\Tasks\Repository;

use App\Tasks\Entity\TaskFactory;
use PhpSpec\ObjectBehavior;
use Tests\Gateway\FakeGateway;

class TaskRepositorySpec extends ObjectBehavior
{
    const NAME = 'todolist.task.added';
    const PROGRESS = 56;

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

}
