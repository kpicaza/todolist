<?php

namespace spec\App\Security\Provider;

use App\Organizations\Entity\Organization;
use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationId;
use App\Users\Entity\User;
use App\Users\Entity\UserFactory;
use App\Users\Gateway\UserGateway;
use App\Users\Repository\UserRepository;
use App\Security\Provider\UserProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Tests\Gateway\FakeGateway;

class UserProviderSpec extends ObjectBehavior
{
    const ORGANIZATION = 'Foo Bar';
    const USERNAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';

    private $prophet;

    private $factory;

    private $organization;

    function let()
    {
        $this->prophet = new Prophet();

        $this->factory = new UserFactory(
            new BCryptPasswordEncoder(4),
            new OrganizationFactory()
        );

        $this->organization = new Organization(
            OrganizationId::fromString(Uuid::uuid4()),
            self::ORGANIZATION
        );
    }


    function it_can_load_user_by_username()
    {
        $gateway = $this->prophet->prophesize(UserGateway::class);

        $repository = new UserRepository(
            $this->factory,
            $gateway->reveal()
        );

        $user = $repository->nextIdentity(
            $this->organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $user = $repository->save($user);

        $gateway->findOneBy(['username' => self::USERNAME])->willReturn($user);

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

        $user = $repository->nextIdentity(
            $this->organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $user = $repository->save($user);

        $gateway->findOneBy(['username' => self::USERNAME])->willReturn($user);

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

        $user = $repository->nextIdentity(
            $this->organization,
            self::USERNAME,
            self::EMAIL,
            self::PASS
        );

        $user = $repository->save($user);
        $gateway->findOneBy(['username' => self::USERNAME])->willReturn($user);

        $this->beConstructedWith(
            $repository
        );

        $this->supportsClass(User::class)->shouldBe(true);
    }
}
