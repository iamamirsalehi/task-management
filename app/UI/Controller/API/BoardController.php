<?php

namespace App\UI\Controller\API;


use App\Application\Command\AddNewBoardCommand;
use App\Domain\Entity\Board\Description;
use App\Domain\Entity\Board\Name;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Exception\BusinessException;
use App\Infrastructure\CommandBus\CommandBus;
use App\UI\Request\AddNewBoardRequest;
use App\UI\Response\JsonResponse;
use Illuminate\Http\Response;

final readonly class BoardController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function add(AddNewBoardRequest $request): Response
    {
        try {
            $addNewBoardCommand = new AddNewBoardCommand(
                new Name($request->get('name')),
                new UserID($request->get('user_id')),
            );

            if ($request->has('description')) {
                $addNewBoardCommand->setDescription(new Description($request->get('description')));
            }

            $this->commandBus->handle($addNewBoardCommand);
        } catch (BusinessException $exception) {
            return JsonResponse::unprocessableEntity($exception->getMessage());
        }

        return JsonResponse::created('added');
    }
}
