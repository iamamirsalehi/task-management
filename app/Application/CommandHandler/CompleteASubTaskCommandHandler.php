<?php

namespace App\Application\CommandHandler;

use App\Application\Command\CompleteASubTaskCommand;
use App\Application\Services\TaskService\TaskService;
use App\Domain\Exception\SubTaskException;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class CompleteASubTaskCommandHandler
{
    public function __construct(
        private TaskRepository    $taskRepository,
        private SubTaskRepository $subTaskRepository,
        private TaskService       $taskService,
    )
    {
    }

    /**
     * @throws SubTaskException
     * @throws TaskException
     */
    public function __invoke(CompleteASubTaskCommand $command): void
    {
        $subTask = $this->subTaskRepository->findByID($command->id);
        if (is_null($subTask)) {
            throw SubTaskException::invalidID();
        }

        $subTask->complete();

        $this->subTaskRepository->save($subTask);

        if (!$this->taskService->areAllSubTasksCompleted($subTask->getParentID())) {
            return;
        }

        $task = $this->taskRepository->findByID($subTask->getParentID());
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $task->complete();

        $this->taskRepository->save($task);
    }
}
