<?php

namespace App\Application\Listener;

use App\Domain\Event\SubTaskRemovedEvent;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class MakeParentTaskNotStartedListener implements ShouldQueue
{
    public function __construct(
        private SubTaskRepository $subTaskRepository,
        private TaskRepository    $taskRepository,
    )
    {
    }

    /**
     * @throws TaskException
     */
    public function handle(SubTaskRemovedEvent $subTaskRemovedEvent): void
    {
        $task = $subTaskRemovedEvent->parentTask;
        $parentSubTasksCount = $this->subTaskRepository->countByParentID($task->getId());
        if ($parentSubTasksCount == 1) {
            $task->changeToNotStarted();

            $this->taskRepository->save($task);
        }
    }
}
