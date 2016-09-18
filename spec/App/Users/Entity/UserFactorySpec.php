<?php

namespace spec\App\Users\Entity;

use App\Users\Entity\User;
use App\Users\Entity\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class UserFactorySpec extends ObjectBehavior
{
    const USERNAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';
    const SALT = 'Do not use this kind of salt';
    const ROLES = [
        'ROLE_USER'
    ];

    function it_should_create_new_user_object_instances()
    {
        $this->beConstructedWith(
            new BCryptPasswordEncoder(4)
        );

        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());

        $user = new User(
            $uuid,
            self::USERNAME,
            self::EMAIL,
            self::PASS,
            self::ROLES
        );

        $new = $this->make(
            null,
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
            new BCryptPasswordEncoder(4)
        );

        $new = $this->make(
            null,
            self::USERNAME,
            self::EMAIL,
            self::PASS,
            self::ROLES
        );

        $new->getPassword()->shouldNotBe(self::PASS);
    }
}
