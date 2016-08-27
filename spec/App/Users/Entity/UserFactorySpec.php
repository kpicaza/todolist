<?php

namespace spec\App\Users\Entity;

use App\Users\Entity\User;
use App\Users\Entity\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

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
        $uuid = \App\Users\Entity\UserId::fromString(Uuid::uuid4());

        $user = new User(
            $uuid,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $new = $this->make(
            $uuid,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $new->id()->shouldBe($user->id());

    }
}
