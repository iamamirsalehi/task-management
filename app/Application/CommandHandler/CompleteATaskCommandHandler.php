<?php

namespace App\Application\CommandHandler;

use App\Application\Command\CompleteATaskCommand;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class CompleteATaskCommandHandler
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(CompleteATaskCommand $command): void
    {
        $task = $this->taskRepository->findByID($command->id);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $task->complete();

        $this->taskRepository->save($task);
    }
}
