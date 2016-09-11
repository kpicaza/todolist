<?php

namespace spec\App\Tasks\Controller;

use App\Tasks\Controller\PostController;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Event\Events;
use App\Tasks\Repository\TaskRepository;
use App\Users\Entity\User;
use App\Users\Entity\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;
use Tests\Gateway\FakeGateway;

class PostControllerSpec extends ObjectBehavior
{
    const NAME = 'Some task description';

    private $dispatcher;

    private $repository;

    private $prophet;

    function let()
    {
        $this->prophet = new Prophet();
        $this->dispatcher = new EventDispatcher();
        $this->repository = new TaskRepository(
            new TaskFactory(),
            new FakeGateway()
        );
    }

    function it_can_create_new_task_giving_a_description()
    {
        $security = $this->prophet->prophesize(PostAuthenticationGuardToken::class);
        $security->getUser()->willReturn(
            new User(UserId::fromString(Uuid::uuid4()), 'paco', 'test@test.mail')
        );

        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository,
            $security
        );

        $request = new Request();
        $request->request->add(['description' => self::NAME]);

        $response  =$this->postAction($request);
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(204);
    }

    function it_must_have_description()
    {
        $security = $this->prophet->prophesize(PostAuthenticationGuardToken::class);
        $security->getUser()->willReturn(
            new User(UserId::fromString(Uuid::uuid4()), 'paco', 'test@test.mail')
        );

        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository,
            $security
        );

        $request = new Request();

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(400);
    }
}
