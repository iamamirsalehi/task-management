<?php

namespace App\Application\Listener;

use App\Application\Services\TaskService\TaskService;
use App\Domain\Event\SubTaskCompletedEvent;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class CompleteParentTaskListener implements ShouldQueue
{
    public function __construct(
        private TaskService    $taskService,
        private TaskRepository $taskRepository,
    )
    {

    }

    /**
     * @throws TaskException
     */
    public function handle(SubTaskCompletedEvent $subTaskCompletedEvent): void
    {
        if (!$this->taskService->areAllSubTasksCompleted($subTaskCompletedEvent->subTask->getParentID())) {
            return;
        }

        $task = $this->taskRepository->findByID($subTaskCompletedEvent->subTask->getParentID());
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $task->complete();

        $this->taskRepository->save($task);
    }
}
