<?php

namespace spec\App\Users\Entity;

use Ramsey\Uuid\Uuid;
use PhpSpec\ObjectBehavior;

class UserIdSpec extends ObjectBehavior
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
