<?php

namespace App\Application\CommandHandler;

use App\Application\Command\StartATaskCommand;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class StartATaskCommandHandler
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(StartATaskCommand $command): void
    {
        $task = $this->taskRepository->findByID($command->id);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $task->start();

        $this->taskRepository->save($task);
    }
}
