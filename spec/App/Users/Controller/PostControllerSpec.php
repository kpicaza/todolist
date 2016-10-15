<?php

namespace spec\App\Users\Controller;

use App\Organizations\Entity\OrganizationFactory;
use App\Users\Controller\PostController;
use App\Users\Entity\UserFactory;
use App\Users\Repository\UserRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Tests\Gateway\FakeGateway;

class PostControllerSpec extends ObjectBehavior
{
    const NAME = 'Some task description';
    const EMAIL = 'foo@bar.mail';
    const PASS = 'fooBar.43';
    const ORGANIZATION = 'my Organization';

    private $dispatcher;

    private $repository;

    private $organizationFactory;

    function let()
    {
        $this->dispatcher = new EventDispatcher();
        $this->organizationFactory = new OrganizationFactory();
        $this->repository = new UserRepository(
            new UserFactory(
                new BCryptPasswordEncoder(4),
                $this->organizationFactory
            ),
            new FakeGateway()
        );
    }

    function it_can_create_new_task_giving_a_username_email_and_password()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository,
            $this->organizationFactory
        );

        $request = new Request();
        $request->request->add(['organization' => self::ORGANIZATION]);
        $request->request->add(['username' => self::NAME]);
        $request->request->add(['email' => self::EMAIL]);
        $request->request->add(['password' => self::PASS]);

        $response = $this->postAction($request);
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(204);
    }

    function it_must_have_username()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository,
            $this->organizationFactory
        );

        $request = new Request();
        $request->request->add(['organization' => self::ORGANIZATION]);
        $request->request->add(['email' => self::EMAIL]);
        $request->request->add(['password' => self::PASS]);

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(400);
    }

    function it_must_have_email()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository,
            $this->organizationFactory
        );

        $request = new Request();
        $request->request->add(['organization' => self::ORGANIZATION]);
        $request->request->add(['username' => self::NAME]);
        $request->request->add(['password' => self::PASS]);

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(400);
    }

    function it_must_have_organization()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository,
            $this->organizationFactory
        );

        $request = new Request();
        $request->request->add(['username' => self::NAME]);
        $request->request->add(['email' => self::EMAIL]);
        $request->request->add(['password' => self::PASS]);

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(400);
    }

    function it_must_have_password()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository,
            $this->organizationFactory
        );

        $request = new Request();
        $request->request->add(['organization' => self::ORGANIZATION]);
        $request->request->add(['username' => self::NAME]);
        $request->request->add(['email' => self::EMAIL]);

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(400);
    }
}
