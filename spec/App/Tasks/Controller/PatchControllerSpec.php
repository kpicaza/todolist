<?php

namespace spec\App\Tasks\Controller;

use App\Tasks\Controller\PatchController;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Repository\TaskRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\Gateway\FakeGateway;

class PatchControllerSpec extends ObjectBehavior
{
    const ID = '550e8400-e29b-41d4-a716-446655440000';
    const DESCRIPTION = 'Some task description';
    const PROGRESS = 57;

    const VALID_COMMANdS = PatchController::VALID_COMMANdS;

    private $prophet;

    private $dispatcher;

    private $repository;

    function let()
    {
        $this->prophet = new Prophet();
        $this->dispatcher = $this->prophet->prophesize(
            EventDispatcherInterface::class
        )->reveal();
        $this->repository = new TaskRepository(
            new TaskFactory(),
            new FakeGateway()
        );
    }

    function it_should_replace_description()
    {
        $task = (new TaskFactory())->make(self::ID, 'Hola mundo');

        $this->repository->save($task);

        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();
        $request->request->add(['replace' => 'description', 'value' => self::DESCRIPTION]);

        $response  =$this->patchAction($request, $task->id());
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(Response::HTTP_ACCEPTED);
    }

    function it_should_replace_progress()
    {
        $task = (new TaskFactory())->make(self::ID, 'Hola mundo');

        $this->repository->save($task);

        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();
        $request->request->add(['replace' => 'progress', 'value' => self::PROGRESS]);

        $response  =$this->patchAction($request, self::ID);
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(Response::HTTP_ACCEPTED);
    }

    function it_must_have_replace_param()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();

        $this->patchAction($request, self::ID)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->patchAction($request, self::ID);

        $response->getStatusCode()->shouldBe(400);
    }

    function it_should_have_valid_command()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();
        $request->request->add(['replace' => 'someOtherThing', 'value' => self::DESCRIPTION]);

        $this->patchAction($request, self::ID)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->patchAction($request, self::ID);

        $response->getStatusCode()->shouldBe(400);
    }

    function it_should_have_value_param()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();
        $request->request->add(['replace' => 'description']);

        $this->patchAction($request, self::ID)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->patchAction($request, self::ID);

        $response->getStatusCode()->shouldBe(400);
    }

    function it_should_have_valid_id()
    {
        $this->beConstructedWith(
            $this->dispatcher,
            $this->repository
        );

        $request = new Request();
        $request->request->add(['replace' => 'description', 'value' => self::DESCRIPTION]);

        $this->patchAction($request, self::ID)->shouldBeAnInstanceOf(JsonResponse::class);

        $response = $this->patchAction($request, self::ID);

        $response->getStatusCode()->shouldBe(400);
    }
}
