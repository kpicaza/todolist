<?php

namespace spec\App\Security\Controller;

use App\Organizations\Entity\Organization;
use App\Organizations\Entity\OrganizationFactory;
use App\Organizations\Entity\OrganizationId;
use App\Security\Controller\CredentialsController;
use App\Users\Entity\UserFactory;
use App\Users\Repository\UserRepository;
use App\Security\Provider\UserProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Tests\Gateway\FakeGateway;

class CredentialsControllerSpec extends ObjectBehavior
{
    const ORGANIZATION = 'Foo Bar';
    const NAME = 'foo';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';

    private $prophet;

    private $dispatcher;

    private $repository;

    private $organization;

    private $config;

    function let()
    {
        $this->prophet = new Prophet();
        $this->dispatcher = new EventDispatcher();
        $this->repository = new UserRepository(
            new UserFactory(
                new BCryptPasswordEncoder(4),
                new OrganizationFactory()
            ),
            new FakeGateway()
        );

        $this->organization = new Organization(
            OrganizationId::fromString(Uuid::uuid4()),
            self::ORGANIZATION
        );

        include __DIR__ . '/../../../../app/config/parameters.php';
        $this->config = $config;
    }

    function it_should_return_a_valid_authentication_bearer()
    {
        $user = $this->repository->nextIdentity(
            $this->organization,
            self::NAME,
            self::EMAIL,
            self::PASS
        );

        $this->repository->save($user);

        $provider = $this->prophet->prophesize(UserProvider::class);
        $provider->loadUserByUsername(self::NAME)->willReturn($user);

        $this->beConstructedWith(
            $this->dispatcher,
            $provider,
            new BCryptPasswordEncoder(4),
            [
                'private.key.path' => $this->config['jws']['private.key.path'],
                'private.key.phrase' => $this->config['jws']['private.key.phrase']
            ]
        );

        $request = new Request();
        $request->request->add(['username' => self::NAME]);
        $request->request->add(['password' => self::PASS]);

        $response = $this->postAction($request);
        $response->shouldBeAnInstanceOf(Response::class);
        $response->getStatusCode()->shouldBe(Response::HTTP_OK);
    }

    function it_must_have_username_or_thrown_unauthorzed_exception()
    {
        $user = $this->repository->nextIdentity(
            $this->organization,
            self::NAME,
            self::EMAIL,
            self::PASS
        );

        $provider = $this->prophet->prophesize(UserProvider::class);
        $provider->loadUserByUsername(self::NAME)->willReturn($user);

        $this->beConstructedWith(
            $this->dispatcher,
            $provider,
            new BCryptPasswordEncoder(4),
            [
                'private.key.path' => $this->config['jws']['private.key.path'],
                'private.key.phrase' => $this->config['jws']['private.key.phrase']
            ]
        );

        $request = new Request();
        $request->request->add(['password' => self::PASS]);

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(Response::HTTP_UNAUTHORIZED);
    }

    function it_must_have_password_or_thrown_unauthorzed_exception()
    {
        $user = $this->repository->nextIdentity(
            $this->organization,
            self::NAME,
            self::EMAIL,
            self::PASS
        );

        $provider = $this->prophet->prophesize(UserProvider::class);
        $provider->loadUserByUsername(self::NAME)->willReturn($user);

        $this->beConstructedWith(
            $this->dispatcher,
            $provider,
            new BCryptPasswordEncoder(4),
            [
                'private.key.path' => $this->config['jws']['private.key.path'],
                'private.key.phrase' => $this->config['jws']['private.key.phrase']
            ]
        );

        $request = new Request();
        $request->request->add(['username' => self::NAME]);

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(Response::HTTP_UNAUTHORIZED);
    }

    function it_must_have_valid_username_and_password_or_thrown_unauthorzed_exception()
    {
        $user = $this->repository->nextIdentity(
            $this->organization,
            self::NAME,
            self::EMAIL,
            self::PASS
        );

        $provider = $this->prophet->prophesize(UserProvider::class);
        $provider->loadUserByUsername(self::NAME)->willReturn($user);

        $this->beConstructedWith(
            $this->dispatcher,
            $provider,
            new BCryptPasswordEncoder(4),
            [
                'private.key.path' => $this->config['jws']['private.key.path'],
                'private.key.phrase' => $this->config['jws']['private.key.phrase']
            ]
        );

        $request = new Request();
        $request->request->add(['username' => self::NAME]);
        $request->request->add(['password' => 'Some invalid pass']);

        $response = $this->postAction($request);
        $response->shouldBeAnInstanceOf(Response::class);
        $response->getStatusCode()->shouldBe(Response::HTTP_UNAUTHORIZED);
    }
}
