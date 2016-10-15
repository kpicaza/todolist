<?php

namespace spec\App\Organizations\Entity;

use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class OrganizationFactorySpec extends ObjectBehavior
{
    const NAME = 'Company Name';

    function it_should_create_new_organization_object_instances()
    {
        $organizationId = OrganizationId::fromString(Uuid::uuid4());

        $organization = $this->make($organizationId, self::NAME);
        $organization->id()->shouldBe((string) $organizationId);
        $organization->getName()->shouldBe(self::NAME);
    }
}
