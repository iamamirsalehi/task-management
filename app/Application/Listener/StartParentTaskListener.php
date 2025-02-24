<?php

namespace App\Application\Listener;

use App\Domain\Event\SubTaskStartedEvent;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

final readonly class StartParentTaskListener implements ShouldQueue
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * @throws TaskException
     */
    public function handle(SubTaskStartedEvent $subTaskStartedEvent): void
    {
        $task = $subTaskStartedEvent->task;
        if (!$task->isNotStarted()) {
            return;
        }

        $task->start();

        $this->taskRepository->save($task);
    }
}
