<?php

namespace App\UI\Controller\API;

use App\Application\Command\AddNewTaskCommand;
use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\Task\Deadline;
use App\Domain\Entity\Task\Description;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Entity\Task\Title;
use App\Domain\Exception\BusinessException;
use App\Infrastructure\CommandBus\CommandBus;
use App\UI\Request\API\AddNewTaskRequest;
use App\UI\Response\JsonResponse;
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
}
