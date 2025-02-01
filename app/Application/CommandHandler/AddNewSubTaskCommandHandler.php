<?php

namespace App\Application\CommandHandler;

use App\Application\Command\AddNewSubTaskCommand;
use App\Domain\Entity\SubTask\SubTask;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class AddNewSubTaskCommandHandler
{
    public function __construct(
        private TaskRepository    $taskRepository,
        private SubTaskRepository $subTaskRepository
    )
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(AddNewSubTaskCommand $command): void
    {
        $task = $this->taskRepository->findByID($command->parentID);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        if ($task->isCompleted()) {
            throw TaskException::canNotHaveSubTask();
        }

        $subTask = new SubTask($command->title, $command->description, $task->getId());

        $this->subTaskRepository->save($subTask);
    }
}
