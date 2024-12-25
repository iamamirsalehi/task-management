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
    public function __invoke(AddNewBoardCommand $command): void
    {
        $existingBoard = $this->boardRepository->findByName($command->getName());
        if ($existingBoard) {
            throw BoardException::boardAlreadyExists();
        }

        $board = new Board($command->getName(), $command->getUserID());
        if (!empty($command->getDescription())) {
            $board->setDescription($command->getDescription());
        }

        $this->boardRepository->save($board);
    }
}
