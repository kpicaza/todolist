<?php

namespace spec\App\Users\Security\Provider;

use App\Users\Entity\User;
use App\Users\Entity\UserFactory;
use App\Users\Gateway\UserGateway;
use App\Users\Repository\UserRepository;
use App\Users\Security\Provider\UserProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Tests\Gateway\FakeGateway;

class UserProviderSpec extends ObjectBehavior
{
    const USERNAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';

    private $prophet;

    private $factory;

    function let()
    {
        $this->prophet = new Prophet();

        $this->factory = new UserFactory(
            new BCryptPasswordEncoder(4)
        );

    }


    function it_can_load_user_by_username()
    {
        $gateway = $this->prophet->prophesize(UserGateway::class);

        $repository = new UserRepository(
            $this->factory,
            $gateway->reveal()
        );

        $user = $repository->insert(
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );
        $gateway->findOneBy(['username'=>self::USERNAME])->willReturn($user);

        $this->beConstructedWith(
            $repository
        );

        $this->loadUserByUsername(self::USERNAME)->shouldBe($user);
    }

    function it_should_thrown_username_not_found_exception_when_username_does_not_exist()
    {
        $gateway = $this->prophet->prophesize(UserGateway::class);

        $repository = new UserRepository(
            $this->factory,
            $gateway->reveal()
        );

        $this->beConstructedWith(
            $repository
        );

        $this->shouldThrow(
            UsernameNotFoundException::class
        )->during('loadUserByUsername', [self::USERNAME]);
    }

    function it_can_refresh_current_user()
    {
        $gateway = $this->prophet->prophesize(UserGateway::class);

        $repository = new UserRepository(
            $this->factory,
            $gateway->reveal()
        );

        $user = $repository->insert(
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );
        $gateway->findOneBy(['username'=>self::USERNAME])->willReturn($user);

        $this->beConstructedWith(
            $repository
        );

        $this->refreshUser($user)->shouldBe($user);
    }

    function it_should_be_instace_of_a_valid_user_class()
    {
        $gateway = $this->prophet->prophesize(UserGateway::class);

        $repository = new UserRepository(
            $this->factory,
            $gateway->reveal()
        );

        $user = $repository->insert(
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );
        $gateway->findOneBy(['username'=>self::USERNAME])->willReturn($user);

        $this->beConstructedWith(
            $repository
        );

        $this->supportsClass(User::class)->shouldBe(true);
    }
}
