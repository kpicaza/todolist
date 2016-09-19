<?php

namespace spec\App\Users\Repository;

use App\Organizations\Entity\Organization;
use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationId;
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
    const ORGANIZATION = 'my Organization';
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
            new BCryptPasswordEncoder(4),
            new OrganizationFactory()
        );

        $organization = new Organization(
            OrganizationId::fromString(Uuid::uuid4()),
            self::ORGANIZATION
        );

        $user = $factory->make(null, $organization, self::NAME, self::EMAIL, self::PASS, self::ROLES);

        $this->beConstructedWith(
            $factory,
            $gateway
        );

        $fakeUser = $this->nextIdentity($organization, self::NAME, self::EMAIL, self::PASS, self::ROLES);
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
            new BCryptPasswordEncoder(4),
            new OrganizationFactory()
        );

        $organization = new Organization(
            OrganizationId::fromString(Uuid::uuid4()),
            self::ORGANIZATION
        );

        $user = $factory->make(null, $organization, self::NAME, self::EMAIL, self::PASS, self::ROLES);

        $fakeFactory = $this->prophet->prophesize(UserFactory::class);
        $fakeFactory->make(null, $organization, self::NAME, self::EMAIL, self::PASS, self::ROLES)->willReturn($user);

        $this->beConstructedWith(
            $fakeFactory,
            $gateway
        );

        $fakeUser = $this->nextIdentity($organization, self::NAME, self::EMAIL, self::PASS, self::ROLES);
        $fakeUser = $this->save($fakeUser);

        $fakeUser->getOrganization()->shouldBe($organization);
        $fakeUser->getUsername()->shouldBe($user->getUsername());
        $fakeUser->getEmail()->shouldBe($user->getEmail());
        $fakeUser->getPassword()->shouldBe($user->getPassword());
        $fakeUser->getRoles()->shouldBe($user->getRoles());
    }
}
