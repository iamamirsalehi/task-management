<?php

namespace App\Application\CommandHandler;

use App\Application\Command\AddNewTaskCommand;
use App\Domain\Entity\Task\Task;
use App\Domain\Exception\BoardException;
use App\Domain\Persistence\Repository\BoardRepository;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class AddNewTaskCommandHandler
{
    public function __construct(
        private TaskRepository  $taskRepository,
        private BoardRepository $boardRepository,
    )
    {
    }

    /**
     * @throws BoardException
     */
    public function __invoke(AddNewTaskCommand $addNewTaskCommand): void
    {
        $board = $this->boardRepository->findByID($addNewTaskCommand->getBoardID());
        if (is_null($board)) {
            throw BoardException::invalidID();
        }

        $task = new Task($addNewTaskCommand->getTitle(), $board->getId(), $addNewTaskCommand->getUserID());

        if ($addNewTaskCommand->getDescription()) {
            $task->setDescription($addNewTaskCommand->getDescription());
        }

        if ($addNewTaskCommand->getDeadline()) {
            $task->setDeadline($addNewTaskCommand->getDeadline());
        }

        $this->taskRepository->save($task);
    }
}
