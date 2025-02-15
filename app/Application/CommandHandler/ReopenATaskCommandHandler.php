<?php

namespace App\Application\CommandHandler;

use App\Application\Command\ReopenATaskCommand;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class ReopenATaskCommandHandler
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(ReopenATaskCommand $command): void
    {
        $task = $this->taskRepository->findByID($command->id);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $task->reopen();

        $this->taskRepository->save($task);
    }
}
