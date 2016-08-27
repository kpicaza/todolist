<?php

namespace spec\App\Users\Repository;

use App\Users\Entity\UserFactory;
use App\Users\Repository\UserRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Tests\Gateway\FakeGateway;

class UserRepositorySpec extends ObjectBehavior
{
    const NAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';

    private $prophet;

    function let()
    {
        $this->prophet = new Prophet();
    }

    function it_should_persist_new_tasks()
    {
        $gateway = new FakeGateway();
        $factory = new UserFactory();

        $user = $factory->make(self::NAME, self::EMAIL, self::PASS);


        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeUser = $this->insert(self::NAME, self::EMAIL, self::PASS);
        $fakeUser->getUsername()->shouldBe($user->getUsername());
        $fakeUser->getEmail()->shouldBe($user->getEmail());
        $fakeUser->getPassword()->shouldBe($user->getPassword());
    }
}
