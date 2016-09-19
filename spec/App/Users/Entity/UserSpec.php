<?php

namespace spec\App\Users\Entity;

use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationId;
use App\Users\Entity\User;
use App\Users\Entity\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class UserSpec extends ObjectBehavior
{
    const USERNAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';
    const SALT = 'Do not use this kind of salt';
    const ROLES = [
        'ROLE_USER'
    ];

    function it_has_random_unique_Identifier()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $this->id()->shouldBe($uuid);
    }

    function it_should_have_username()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $this->getUsername()->shouldBe(self::USERNAME);
    }

    function it_cannot_have_empty_username()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            '',
            self::EMAIL,
            self::PASS
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_should_have_email()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $this->getEmail()->shouldBe(self::EMAIL);
    }

    function it_cannot_have_empty_email()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            '',
            self::PASS
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_should_have_password()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $this->getPassword()->shouldBe(self::PASS);
    }

    function it_should_have_roles()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS,
            self::ROLES
        );

        $this->getRoles()->shouldBe(self::ROLES);
    }

    function it_should_have_salt()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS,
            [],
            self::SALT
        );

        $this->getSalt()->shouldBe(self::SALT);
    }

    function it_should_have_organization()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS,
            [],
            self::SALT
        );

        $this->getOrganization()->shouldBe($organization);
    }

    function it_has_created_at_date_time()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL
        );

        $this->setCreatedAt();
        $this->getCreatedAt()->shouldBeAnInstanceOf(\DateTimeInterface::class);
    }

    function it_has_updated_at_date_time()
    {
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());
        $organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            'company name'
        );

        $this->beConstructedWith(
            $uuid,
            $organization,
            self::USERNAME,
            self::EMAIL
        );

        $this->setUpdatedAt();
        $this->getUpdatedAt()->shouldBeAnInstanceOf(\DateTimeInterface::class);
    }

}
