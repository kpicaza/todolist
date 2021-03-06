<?php

namespace spec\App\Tasks\Repository;

use App\Tasks\Entity\Task;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Gateway\TaskGateway;
use App\Users\Entity\UserId;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;
use Tests\Gateway\FakeGateway;

class TaskRepositorySpec extends ObjectBehavior
{
    const NAME = 'todolist.task.added';
    const DESCRIPTION = 'This is fake description';
    const PROGRESS = 56;
    const PROGREES2 = 85;

    private $prophet;

    function let()
    {
        $this->prophet = new Prophet();
    }


    function it_should_return_next_task_identity()
    {
        $gateway = new FakeGateway();
        $factory = new TaskFactory();

        $userId = UserId::fromString(Uuid::uuid4());
        $task = $factory->make(null, $userId, self::NAME, self::PROGRESS);

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeTask = $this->nextIdentity($userId, self::NAME, self::PROGRESS);

        $fakeTask->getDescription()->shouldBe($task->getDescription());
        $fakeTask->getProgress()->get()->shouldBe($task->getProgress()->get());
    }

    function it_should_persist_save_tasks()
    {
        $gateway = new FakeGateway();
        $factory = new TaskFactory();

        $task = $factory->make(null, UserId::fromString(Uuid::uuid4()),  self::NAME, self::PROGRESS);

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeTask = $this->save($task);
        $fakeTask->getDescription()->shouldBe($task->getDescription());
        $fakeTask->getProgress()->get()->shouldBe($task->getProgress()->get());
    }

    function it_can_obtain_a_list_of_items()
    {
        $factory = new TaskFactory();

        $task = $factory->make(null, UserId::fromString(Uuid::uuid4()), self::NAME, self::PROGRESS);

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

    function it_can_save_task_description()
    {
        $factory = new TaskFactory();
        $gateway = new FakeGateway();

        $task = $factory->make(null, UserId::fromString(Uuid::uuid4()), self::NAME, self::PROGRESS);

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeTask = $this->saveDescription($task, self::DESCRIPTION);

        $fakeTask->id()->shouldBe($task->id());
        $fakeTask->getDescription()->shouldBe(self::DESCRIPTION);
        $fakeTask->getProgress()->get()->shouldBe($task->getProgress()->get());

    }

    function it_can_save_task_progress()
    {
        $factory = new TaskFactory();
        $gateway = new FakeGateway();

        $task = $factory->make(null, UserId::fromString(Uuid::uuid4()), self::NAME, self::PROGRESS);

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeTask = $this->saveProgress($task, self::PROGREES2);

        $fakeTask->id()->shouldBe($task->id());
        $fakeTask->getDescription()->shouldBe($task->getDescription());
        $fakeTask->getProgress()->get()->shouldBe(self::PROGREES2);
    }

    function it_should_return_true_if_it_can_delete_task()
    {
        $factory = new TaskFactory();

        $task = $factory->make(null, UserId::fromString(Uuid::uuid4()), self::NAME, self::PROGRESS);

        $id = $task->id();

        $gateway = $this->prophet->prophesize(TaskGateway::class);
        $gateway
            ->findBy(['id' => $id])
            ->willReturn([$task]);
        $gateway->delete($task)->willReturn();

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $this->delete($id)->shouldBe(true);
    }

    function it_should_return_false_if_it_can_not_delete_task()
    {
        $factory = new TaskFactory();

        $task = $factory->make(null, UserId::fromString(Uuid::uuid4()), self::NAME, self::PROGRESS);

        $id = $task->id();

        $gateway = $this->prophet->prophesize(TaskGateway::class);
        $gateway
            ->findBy(['id' => $id])
            ->willReturn([]);
        $gateway->delete($task)->willReturn();

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $this->delete($id)->shouldBe(false);
    }

}
