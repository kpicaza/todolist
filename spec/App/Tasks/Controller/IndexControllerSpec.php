<?php

namespace spec\App\Tasks\Controller;

use App\Tasks\Controller\IndexController;
use App\Tasks\Entity\TaskFactory;
use App\Tasks\Repository\TaskRepository;
use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Tests\Gateway\FakeGateway;

class IndexControllerSpec extends ObjectBehavior
{
    private $repository;

    function let()
    {
        $this->repository = new TaskRepository(
            new TaskFactory(),
            new FakeGateway()
        );
    }

    function it_can_retrieve_a_list_of_tasks()
    {
        $this->beConstructedWith(
            $this->repository
        );

        $request = new Request();

        $response = $this->getAction($request);
        $response->shouldBeAnInstanceOf(JsonResponse::class);
        $response->getStatusCode()->shouldBe(200);

    }
}
