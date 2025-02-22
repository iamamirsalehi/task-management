<?php

namespace App\UI\Controller\API;

use App\Application\Command\AddNewTaskCommand;
use App\Application\Command\AssignDeadlineToATaskCommand;
use App\Application\Command\CompleteATaskCommand;
use App\Application\Command\PrioritizeATaskCommand;
use App\Application\Command\ReopenATaskCommand;
use App\Application\Command\StartATaskCommand;
use App\Application\Query\FilterTasksQuery;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Exception\BusinessException;
use App\Infrastructure\CommandBus\CommandBus;
use App\Infrastructure\QueryBus\QueryBus;
use App\UI\Request\API\AddNewTaskRequest;
use App\UI\Request\API\AssignDeadlineToATaskRequest;
use App\UI\Request\API\FilterTasksRequest;
use App\UI\Request\API\PrioritizeATaskRequest;
use App\UI\Resource\API\TaskResource;
use App\UI\Response\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final readonly class TaskController
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus   $queryBus,
    )
    {
    }

    public function filter(FilterTasksRequest $request): Response
    {
        $filterTask = new FilterTasksQuery(
            $request->getStatus(),
            $request->getPriority(),
        );

        $tasks = $this->queryBus->handle($filterTask);

        return JsonResponse::ok('', TaskResource::collection($tasks)->toArray($request));
    }

    public function add(AddNewTaskRequest $request): Response
    {
        try {
            $addNewTaskCommand = new AddNewTaskCommand(
                $request->getTitle(),
                $request->getBoardID(),
                $request->getUserID(),
                $request->getDescription(),
                $request->getDeadline(),
            );

            $this->commandBus->handle($addNewTaskCommand);
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::created();
    }

    public function start(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new StartATaskCommand(new ID($id), new UserID($request->get('user_id'))));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }

    public function complete(Request $request, $id): Response
    {
        try {
            $taskID = new ID($id);
            $userID = new UserID($request->get('user_id'));

            $this->commandBus->handle(new CompleteATaskCommand($taskID, $userID));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }

    public function reopen(Request $request, $id): Response
    {
        try {
            $taskID = new ID($id);
            $userID = new UserID($request->get('user_id'));

            $this->commandBus->handle(new ReopenATaskCommand($taskID, $userID));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }

    public function prioritize(PrioritizeATaskRequest $request, $id): Response
    {
        try {
            $this->commandBus->handle(new PrioritizeATaskCommand(new ID($id), $request->getPriority()));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }

    public function assignDeadline(AssignDeadlineToATaskRequest $request, $id): Response
    {
        try {
            $this->commandBus->handle(new AssignDeadlineToATaskCommand(new ID($id), $request->getDeadline()));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }
}
