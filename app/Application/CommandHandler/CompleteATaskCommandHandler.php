<?php

namespace App\Application\CommandHandler;

use App\Application\Command\CompleteATaskCommand;
use App\Application\Services\TaskService\TaskService;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class CompleteATaskCommandHandler
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskService    $taskService,
    )
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(CompleteATaskCommand $completeATaskCommand): void
    {
        $task = $this->taskRepository->findByID($completeATaskCommand->id);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        if (!$this->taskService->areAllSubTasksCompleted($task->getId())) {
            throw TaskException::allSubTasksMustBeCompleted();
        }

        $task->complete();

        $this->taskRepository->save($task);
    }
}
