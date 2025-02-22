<?php

namespace App\Application\CommandHandler;

use App\Application\Command\AddNewBoardCommand;
use App\Domain\Entity\Board\Board;
use App\Domain\Exception\BoardException;
use App\Domain\Persistence\Repository\BoardRepository;

final readonly class AddNewBoardCommandHandler
{
    public function __construct(private BoardRepository $boardRepository)
    {
    }

    /**
     * @throws BoardException
     */
    public function __invoke(AddNewBoardCommand $addNewBoardCommand): void
    {
        $existingBoard = $this->boardRepository->findByName($addNewBoardCommand->getName());
        if ($existingBoard) {
            throw BoardException::boardAlreadyExists();
        }

        $board = new Board(
            $addNewBoardCommand->getName(),
            $addNewBoardCommand->getOwnerID(),
            $addNewBoardCommand->getDescription(),
        );

        $this->boardRepository->save($board);
    }
}
