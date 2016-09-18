<?php

namespace spec\App\Organizations\Entity;

use App\Organizations\Entity\Organization;
use App\Organizations\Entity\OrganizationId;
use App\Users\Entity\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;

class OrganizationSpec extends ObjectBehavior
{
    const NAME = 'Company Name';

    function it_should_have_an_id()
    {
        $id = OrganizationId::fromString(Uuid::uuid4());
        $this->beConstructedWith(
            $id,
            self::NAME
        );

        $this->id()->shouldBe((string) $id);
    }

    function it_should_have_a_name()
    {
        $this->beConstructedWith(
            OrganizationId::fromString(Uuid::uuid4()),
            self::NAME
        );

        $this->getName()->shouldBe(self::NAME);
    }

    function it_should_be_json_serializable()
    {
        $this->beConstructedWith(
            OrganizationId::fromString(Uuid::uuid4()),
            self::NAME
        );

        $array = $this->jsonSerialize();
        $this->id()->shouldBe($array['id']);
        $this->getName()->shouldBe($array['name']);
    }
}
