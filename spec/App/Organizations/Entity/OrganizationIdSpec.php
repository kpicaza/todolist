<?php

namespace spec\App\Organizations\Entity;

use App\Organizations\Entity\OrganizationId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class OrganizationIdSpec extends ObjectBehavior
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
