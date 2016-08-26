<?php

namespace spec\App\Tasks\Entity;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;
use App\Common\Entity\Progress;
use App\Tasks\Entity\TaskId;

class TaskSpec extends ObjectBehavior
{
    const DONE = true;
    const UNDONE = false;
    const PROGRESS = 56;
    const DESCRIPTION = 'Arthur and Bedevere attempt to satisfy the strange requests of the dreaded Knights who say Ni';

    function it_has_random_unique_Identifier()
    {
        $uuid = TaskId::fromString(Uuid::uuid4());

        $this->beConstructedWith(
            $uuid,
            new Progress(self::PROGRESS),
            self::DESCRIPTION
        );

        $this->id()->shouldBe((string) $uuid);
    }

    function it_should_be_marked_as_done_or_undone()
    {
        $this->beConstructedWith(
            TaskId::fromString(Uuid::uuid4()),
            new Progress(self::PROGRESS),
            self::DESCRIPTION
        );

        $this->getProgress()->isDone()->shouldBe(self::UNDONE);
    }

    function it_has_progress_counter()
    {
        $this->beConstructedWith(
            TaskId::fromString(Uuid::uuid4()),
            new Progress(self::PROGRESS),
            self::DESCRIPTION
        );

        $this->getProgress()->get()->shouldBe(self::PROGRESS);
    }

    function it_has_description()
    {
        $this->beConstructedWith(
            TaskId::fromString(Uuid::uuid4()),
            new Progress(self::PROGRESS),
            self::DESCRIPTION
        );

        $this->getDescription()->shouldBe(self::DESCRIPTION);
    }

    function it_has_created_at_date_time()
    {
        $this->beConstructedWith(
            TaskId::fromString(Uuid::uuid4()),
            new Progress(self::PROGRESS),
            self::DESCRIPTION
        );

        $this->setCreatedAt();
        $this->getCreatedAt()->shouldBeAnInstanceOf(\DateTimeInterface::class);
    }

    function it_has_updated_at_date_time()
    {
        $this->beConstructedWith(
            TaskId::fromString(Uuid::uuid4()),
            new Progress(self::PROGRESS),
            self::DESCRIPTION
        );

        $this->setUpdatedAt();
        $this->getUpdatedAt()->shouldBeAnInstanceOf(\DateTimeInterface::class);
    }

    function it_cannot_have_empty_description()
    {
        $this->beConstructedWith(
            TaskId::fromString(Uuid::uuid4()),
            new Progress(self::PROGRESS),
            ''
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }
}
