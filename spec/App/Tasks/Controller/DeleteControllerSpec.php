<?php

namespace spec\App\Tasks\Controller;

use App\Tasks\Controller\DeleteController;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Repository\TaskRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tests\Gateway\FakeGateway;

class DeleteControllerSpec extends ObjectBehavior
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

    function it_should_response_with_no_content_http_status_if_task_is_sucessfully_deleted()
    {
        $task = (new TaskFactory())->make(null, 'Hola mundo');

        $this->repository->save($task);

        $this->beConstructedWith(
            $this->repository
        );

        $request = new Request();

        $response = $this->deleteAction($request, (string) $task->id());
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(204);
    }

    function it_should_response_with_not_found_http_error_if_task_not_exist()
    {
        $task = (new TaskFactory())->make(null, 'Hola mundo');

        $this->beConstructedWith(
            $this->repository
        );

        $request = new Request();

        $response = $this->deleteAction($request, (string) $task->id());
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(404);
    }
}
