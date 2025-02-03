<?php

namespace App\UI\Controller\API;


use App\Application\Command\AddNewBoardCommand;
use App\Application\Query\GetAllUserBoardsQuery;
use App\Application\Query\GetBoardTasksQuery;
use App\Domain\Entity\Board\Description;
use App\Domain\Entity\Board\Name;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Exception\BusinessException;
use App\Infrastructure\CommandBus\CommandBus;
use App\Infrastructure\QueryBus\QueryBus;
use App\UI\Request\API\AddNewBoardRequest;
use App\UI\Request\API\GetTasksRequest;
use App\UI\Resource\API\BoardResource;
use App\UI\Resource\API\TaskResource;
use App\UI\Response\JsonResponse;
use Assert\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final readonly class BoardController
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus   $queryBus,
    )
    {
    }

    public function add(AddNewBoardRequest $request): Response
    {
        try {
            $addNewBoardCommand = new AddNewBoardCommand(
                new Name($request->get('name')),
                new UserID((int)$request->get('user_id')),
            );

            if ($request->has('description')) {
                $addNewBoardCommand->setDescription(new Description($request->get('description')));
            }

            $this->commandBus->handle($addNewBoardCommand);
        } catch (BusinessException|InvalidArgumentException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::created('added');
    }

    public function getUserBoards(Request $request, int $userID): Response
    {
        try {
            $userID = new UserID($userID);

            $boards = $this->queryBus->handle((new GetAllUserBoardsQuery($userID)));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('', BoardResource::collection($boards)->toArray($request));
    }

    public function getTasks(GetTasksRequest $request, $id): Response
    {
        try {
            $userID = new UserID($request->get('user_id'));
            $boardID = new BoardID($id);

            $tasks = $this->queryBus->handle(new GetBoardTasksQuery($boardID, $userID));
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::ok('', TaskResource::collection($tasks)->toArray($request));
    }
}
