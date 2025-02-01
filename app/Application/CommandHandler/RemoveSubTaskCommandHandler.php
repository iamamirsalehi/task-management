<?php

namespace App\Application\CommandHandler;

use App\Application\Command\RemoveSubTaskCommand;
use App\Domain\Exception\SubTaskException;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use App\Domain\Persistence\Repository\Transaction;

final readonly class RemoveSubTaskCommandHandler
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
    public function __invoke(RemoveSubTaskCommand $command): void
    {
        $subTask = $this->subTaskRepository->findByID($command->id);
        if (is_null($subTask)) {
            throw SubTaskException::invalidID();
        }

        $task = $this->taskRepository->findByID($subTask->getParentID());
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $this->transaction->warp(function () use ($subTask, $task) {
            $parentSubTasksCount = $this->subTaskRepository->countByParentID($task->getId());
            if ($parentSubTasksCount == 1) {
                $task->changeToNotStarted();

                $this->taskRepository->save($task);
            }

            $this->subTaskRepository->remove($subTask);
        });
    }
}
