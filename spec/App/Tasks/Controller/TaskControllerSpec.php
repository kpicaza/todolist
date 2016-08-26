<?php

namespace spec\App\Tasks\Controller;

use App\Tasks\Controller\TaskController;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Event\Events;
use App\Tasks\Repository\TaskRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tests\Gateway\FakeGateway;

class TaskControllerSpec extends ObjectBehavior
{
    const NAME = 'Some task description';

    private $dispatcher;

    private $repository;

    function let()
    {
        $this->dispatcher = new EventDispatcher();
        $this->repository = new TaskRepository(
            new TaskFactory(),
            new FakeGateway()
        );
    }

    function it_can_create_new_task_giving_a_description()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();
        $request->request->add(['description' => self::NAME]);

        $response  =$this->postAction($request);
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(204);
    }

    function it_must_have_description()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();

        $this->postAction($request)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->postAction($request);

        $response->getStatusCode()->shouldBe(400);
    }

}
