<?php

namespace App\Application\CommandHandler;

use App\Application\Command\RemoveSubTaskCommand;
use App\Domain\Event\SubTaskRemovedEvent;
use App\Domain\Exception\SubTaskException;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class RemoveSubTaskCommandHandler
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

        $this->subTaskRepository->remove($subTask);

        $this->dispatcher->dispatch(new SubTaskRemovedEvent($task));
    }
}
