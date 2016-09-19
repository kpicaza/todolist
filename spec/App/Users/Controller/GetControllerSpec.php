<?php

namespace spec\App\Users\Controller;

use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationId;
use App\Users\Controller\GetController;
use App\Users\Entity\UserFactory;
use App\Users\Repository\UserRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Tests\Gateway\FakeGateway;

class GetControllerSpec extends ObjectBehavior
{
    const USERNAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';
    const SALT = 'Do not use this kind of salt';
    const ROLES = [
        'ROLE_USER'
    ];
    const ORGANIZATION = 'my Organization';

    private $prophet;
    private $userFactory;
    private $repository;
    private $organization;

    function let()
    {
        $this->prophet = new Prophet();
        $this->userFactory = new UserFactory(
            new BCryptPasswordEncoder(4),
            new OrganizationFactory()
        );
        $this->repository = new UserRepository(
            $this->userFactory,
            new FakeGateway()
        );

        $this->organization = (new OrganizationFactory())->make(
            OrganizationId::fromString(Uuid::uuid4()),
            self::ORGANIZATION
        );
    }

    function it_can_retrieve_a_certain_user()
    {
        $user = $this->userFactory->make(null, $this->organization, self::USERNAME, self::EMAIL, self::PASS, self::ROLES);

        $repository = $this->prophet->prophesize(UserRepository::class);
        $repository
            ->findOneBy(['id' => $user->id()])
            ->willReturn([$user]);

        $this->beConstructedWith(
            $repository->reveal()
        );

        $request = new Request();

        $response = $this->getAction($request, (string)$user->id());
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(200);
    }

    function it_should_response_with_not_found_http_error_if_user_not_exist()
    {
        $this->beConstructedWith(
            $this->repository
        );

        $request = new Request();

        $response = $this->getAction($request, 'someErrorId');
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(404);
    }
}
