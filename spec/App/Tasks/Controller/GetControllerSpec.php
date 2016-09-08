<?php

namespace spec\App\Tasks\Controller;

use App\Tasks\Controller\GetController;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Repository\TaskRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tests\Gateway\FakeGateway;

class GetControllerSpec extends ObjectBehavior
{
    private $prophet;

    private $repository;

    function let()
    {
        $this->prophet = new Prophet();
        $this->repository = new TaskRepository(
            new TaskFactory(),
            new FakeGateway()
        );
    }

    function it_can_retrieve_a_certain_task()
    {
        $task = (new TaskFactory())->make(null, 'Hola mundo');

        $repository = $this->prophet->prophesize(TaskRepository::class);
        $repository
            ->findBy(['id' => $task->id()], null, null, null)
            ->willReturn([$task])
        ;

        $this->beConstructedWith(
            $repository->reveal()
        );

        $request = new Request();

        $response = $this->getAction($request, (string) $task->id());
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(200);
    }

    function it_should_response_with_not_found_http_error_if_task_not_exist()
    {
        $task = (new TaskFactory())->make(null, 'Hola mundo');

        $this->beConstructedWith(
            $this->repository
        );

        $request = new Request();

        $response = $this->getAction($request, (string) $task->id());
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(404);
    }
}
