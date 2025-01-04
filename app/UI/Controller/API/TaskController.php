<?php

namespace App\UI\Controller\API;

use App\Application\Command\AddNewTaskCommand;
use App\Application\Command\AssignDeadlineToATaskCommand;
use App\Application\Command\CompleteATaskCommand;
use App\Application\Command\PrioritizeATaskCommand;
use App\Application\Command\ReopenATaskCommand;
use App\Application\Command\StartATaskCommand;
use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\Enums\TaskPriority;
use App\Domain\Entity\Task\Deadline;
use App\Domain\Entity\Task\Description;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Entity\Task\Title;
use App\Domain\Exception\BusinessException;
use App\Infrastructure\CommandBus\CommandBus;
use App\UI\Request\API\AddNewTaskRequest;
use App\UI\Request\API\AssignDeadlineToATaskRequest;
use App\UI\Request\API\PrioritizeATaskRequest;
use App\UI\Response\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final readonly class TaskController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function add(AddNewTaskRequest $request): Response
    {
        try {
            $title = new Title($request->get('title'));
            $boardID = new BoardID($request->get('board_id'));
            $userID = new UserID($request->get('user_id'));

            $addNewTaskCommand = new AddNewTaskCommand($title, $boardID, $userID);
            if ($request->has('description')) {
                $description = new Description($request->get('description'));
                $addNewTaskCommand->setDescription($description);
            }

            if ($request->has('deadline')) {
                $deadline = new Deadline($request->get('deadline'));
                $addNewTaskCommand->setDeadline($deadline);
            }

            $this->commandBus->handle($addNewTaskCommand);
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::created('');
    }

    public function start(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new StartATaskCommand(new ID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('');
    }

    public function complete(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new CompleteATaskCommand(new ID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('');
    }

    public function reopen(Request $request, $id): Response
    {
        try {
            $this->commandBus->handle(new ReopenATaskCommand(new ID($id)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('');
    }

    public function prioritize(PrioritizeATaskRequest $request, $id): Response
    {
        $priority = $request->get('priority');

        try {
            $this->commandBus->handle(new PrioritizeATaskCommand(new ID($id), TaskPriority::from($priority)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('');
    }

    public function assignDeadline(AssignDeadlineToATaskRequest $request, $id): Response
    {
        $deadline = $request->get('deadline');
        try {
            $this->commandBus->handle(new AssignDeadlineToATaskCommand(new ID($id), new Deadline($deadline)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('');
    }
}
