<?php

namespace App\Application\CommandHandler;

use App\Application\Command\StartSubTaskCommand;
use App\Domain\Exception\SubTaskException;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class StartSubTaskCommandHandler
{
    public function __construct(
        private TaskRepository    $taskRepository,
        private SubTaskRepository $subTaskRepository,
    )
    {
    }

    /**
     * @throws TaskException
     * @throws SubTaskException
     */
    public function __invoke(StartSubTaskCommand $command): void
    {
        $subTask = $this->subTaskRepository->findByID($command->id);
        if (is_null($subTask)) {
            throw SubTaskException::invalidID();
        }

        $task = $this->taskRepository->findByID($subTask->getParentID());
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        if ($task->isCompleted()) {
            throw SubTaskException::parentMustNotBeCompleted();
        }

        if ($task->isNotStarted()) {
            $task->start();
        }

        $subTask->start();

        $this->subTaskRepository->save($subTask);
        $this->taskRepository->save($task);
    }
}
