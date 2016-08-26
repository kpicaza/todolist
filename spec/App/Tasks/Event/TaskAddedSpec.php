<?php

namespace spec\App\Tasks\Event;

use App\Common\Entity\Progress;
use App\Tasks\Entity\TaskId;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;
use App\Tasks\Entity\Task;

class TaskAddedSpec extends ObjectBehavior
{
    const NAME = 'todolist.task.added';
    const PROGRESS = 56;

    function it_has_a_name(\DateTime $receivedAt)
    {
        $taskId = new TaskId(Uuid::uuid4());
        $task = new Task($taskId, new Progress(self::PROGRESS), self::NAME);

        $this->beConstructedWith($task, $receivedAt);

        $this->getName()->shouldBe(self::NAME);
    }

    function it_has_task(\DateTime $receivedAt)
    {
        $taskId = new TaskId(Uuid::uuid4());
        $task = new Task($taskId, new Progress(self::PROGRESS), self::NAME);

        $this->beConstructedWith($task, $receivedAt);

        $this->getTask()->shouldBe($task);
    }

    function it_has_been_received_at_a_date_and_time(\DateTime $receivedAt)
    {
        $taskId = new TaskId(Uuid::uuid4());
        $task = new Task($taskId, new Progress(self::PROGRESS), self::NAME);

        $this->beConstructedWith($task, $receivedAt);

        $this->getReceivedAt()->shouldBe($receivedAt);
    }
}
