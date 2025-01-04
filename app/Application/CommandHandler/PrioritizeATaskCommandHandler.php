<?php

namespace App\Application\CommandHandler;

use App\Application\Command\PrioritizeATaskCommand;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class PrioritizeATaskCommandHandler
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(PrioritizeATaskCommand $command): void
    {
        $task = $this->taskRepository->findByID($command->id);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $task->changePriority($command->priority);

        $this->taskRepository->save($task);
    }
}
