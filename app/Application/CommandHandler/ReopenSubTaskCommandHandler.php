<?php

namespace App\Application\CommandHandler;

use App\Application\Command\ReopenSubTaskCommand;
use App\Domain\Event\SubTaskReopenedEvent;
use App\Domain\Exception\SubTaskException;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use App\Domain\Persistence\Repository\Transaction;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class ReopenSubTaskCommandHandler
{
    public function __construct(
        private SubTaskRepository $subTaskRepository,
        private TaskRepository    $taskRepository,
        private Dispatcher        $dispatcher,
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

        $this->subTaskRepository->save($subTask);

        $this->dispatcher->dispatch(new SubTaskReopenedEvent($task));
    }
}
