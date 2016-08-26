<?php

namespace spec\App\Tasks\Entity;

use App\Tasks\Entity\TaskId;
use Ramsey\Uuid\Uuid;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaskIdSpec extends ObjectBehavior
{
    function it_has_random_unique_Identifier()
    {
        $uuid = Uuid::uuid4();

        $this->beConstructedWith(
            $uuid
        );

        $this->__toString()->shouldBe($uuid->toString());
    }

}
