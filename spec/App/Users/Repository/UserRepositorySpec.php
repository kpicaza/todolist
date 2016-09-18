<?php

namespace spec\App\Users\Repository;

use App\Users\Entity\UserFactory;
use App\Users\Entity\UserId;
use App\Users\Repository\UserRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Tests\Gateway\FakeGateway;

class UserRepositorySpec extends ObjectBehavior
{
    const NAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';
    const ROLES = [
        'ROLE_USER'
    ];

    private $prophet;

    function let()
    {
        $this->prophet = new Prophet();
    }

    function it_should_return_next_user_identity()
    {
        $gateway = new FakeGateway();
        $factory = new UserFactory(
            new BCryptPasswordEncoder(4)
        );

        $user = $factory->make(null, self::NAME, self::EMAIL, self::PASS, self::ROLES);

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeUser = $this->nextIdentity(self::NAME, self::EMAIL, self::PASS, self::ROLES);
        $fakeUser = $this->save($fakeUser);


        $fakeUser->getUsername()->shouldBe($user->getUsername());
        $fakeUser->getEmail()->shouldBe($user->getEmail());
      //  $fakeUser->getPassword()->shouldBe($user->getPassword());
        $fakeUser->getRoles()->shouldBe($user->getRoles());
    }

    function it_should_persist_new_users()
    {
        $gateway = new FakeGateway();
        $factory = new UserFactory(
            new BCryptPasswordEncoder(4)
        );

        $user = $factory->make(null, self::NAME, self::EMAIL, self::PASS, self::ROLES);

        $fakeFactory = $this->prophet->prophesize(UserFactory::class);
        $fakeFactory->make(null, self::NAME, self::EMAIL, self::PASS, self::ROLES)->willReturn($user);

        $this->beConstructedWith(
            $fakeFactory,
            $gateway
        );

        $fakeUser = $this->nextIdentity(self::NAME, self::EMAIL, self::PASS, self::ROLES);
        $fakeUser = $this->save($fakeUser);

        $fakeUser->getUsername()->shouldBe($user->getUsername());
        $fakeUser->getEmail()->shouldBe($user->getEmail());
        $fakeUser->getPassword()->shouldBe($user->getPassword());
        $fakeUser->getRoles()->shouldBe($user->getRoles());
    }
}
