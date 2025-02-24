<?php

namespace App\UI\Controller\API;

use App\Application\Command\AddNewSubTaskCommand;
use App\Application\Command\CompleteASubTaskCommand;
use App\Application\Command\RemoveSubTaskCommand;
use App\Application\Command\ReopenSubTaskCommand;
use App\Application\Command\StartSubTaskCommand;
use App\Application\Query\GetTaskSubTasksQuery;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\SubTask\ID as SubTaskID;
use App\Domain\Exception\BusinessException;
use App\Infrastructure\CommandBus\CommandBus;
use App\Infrastructure\QueryBus\QueryBus;
use App\UI\Request\API\AddNewSubTaskRequest;
use App\UI\Resource\API\SubTaskResource;
use App\UI\Response\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final readonly class SubTaskController
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus   $queryBus,
    )
    {
    }

    public function add(AddNewSubTaskRequest $request): Response
    {
        try {
            $this->commandBus->handle(new AddNewSubTaskCommand(
                $request->getTitle(),
                $request->getTaskID(),
                $request->getDescription(),
            ));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::created('SubTask added');
    }


    public function getSubTasks(Request $request, $id): Response
    {
        try {
            $subTasks = $this->queryBus->handle(new GetTaskSubTasksQuery(new ID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('', SubTaskResource::collection($subTasks)->toArray($request));
    }

    public function start(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new StartSubTaskCommand(new SubTaskID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }

    public function complete(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new CompleteASubTaskCommand(new SubTaskID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }

    public function reopen(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new ReopenSubTaskCommand(new SubTaskID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }

    public function remove(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new RemoveSubTaskCommand(new SubTaskID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok();
    }
}
