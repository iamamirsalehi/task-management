<?php

namespace App\Application\Listener;

use App\Domain\Event\SubTaskReopenedEvent;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class MakeParentTaskInProgressListener implements ShouldQueue
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * @throws TaskException
     */
    public function handle(SubTaskReopenedEvent $subTaskReopenedEvent): void
    {
        $task = $subTaskReopenedEvent->parentTask;

        if ($task->isCompleted()) {
            $task->toInProgress();

            $this->taskRepository->save($task);
        }
    }
}
