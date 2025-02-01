<?php

namespace App\Application\CommandHandler;

use App\Application\Command\ReopenSubTaskCommand;
use App\Domain\Exception\SubTaskException;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use App\Domain\Persistence\Repository\Transaction;

final readonly class ReopenSubTaskCommandHandler
{
    public function __construct(
        private SubTaskRepository $subTaskRepository,
        private TaskRepository    $taskRepository,
        private Transaction       $transaction,
    )
    {
    }

    /**
     * @throws SubTaskException
     * @throws TaskException
     */
    public function __invoke(ReopenSubTaskCommand $command): void
    {
        $subTask = $this->subTaskRepository->findByID($command->id);
        if (is_null($subTask)) {
            throw SubTaskException::invalidID();
        }

        $task = $this->taskRepository->findByID($subTask->getParentID());
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $subTask->reopen();

        if ($task->isCompleted()) {
            $task->toInProgress();
        }

        $this->transaction->warp(function () use ($subTask, $task) {
            $this->taskRepository->save($task);

            $this->subTaskRepository->save($subTask);
        });
    }
}
