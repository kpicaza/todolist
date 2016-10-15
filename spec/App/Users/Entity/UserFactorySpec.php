<?php

namespace spec\App\Users\Entity;

use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationId;
use App\Users\Entity\User;
use App\Users\Entity\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class UserFactorySpec extends ObjectBehavior
{
    const ORGANIZATION = 'company name';
    const USERNAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';
    const SALT = 'Do not use this kind of salt';
    const ROLES = [
        'ROLE_USER'
    ];

    private $organization;

    function let()
    {
        $this->organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            self::ORGANIZATION
        );
    }

    function it_should_create_new_user_object_instances()
    {
        $this->beConstructedWith(
            new BCryptPasswordEncoder(4),
            new OrganizationFactory()
        );

        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());

        $user = new User(
            $uuid,
            $this->organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS,
            self::ROLES
        );

        $new = $this->make(
            null,
            $this->organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $new->shouldBeAnInstanceOf(User::class);

        $new->getUsername()->shouldBe($user->getUsername());
    }

    function it_must_have_encoded_password()
    {
        $this->beConstructedWith(
            new BCryptPasswordEncoder(4),
            new OrganizationFactory()
        );

        $new = $this->make(
            null,
            $this->organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS,
            self::ROLES
        );

        $new->getPassword()->shouldNotBe(self::PASS);
    }
}
