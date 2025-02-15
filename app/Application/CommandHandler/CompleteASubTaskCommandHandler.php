<?php

namespace App\Application\CommandHandler;

use App\Application\Command\CompleteASubTaskCommand;
use App\Domain\Event\SubTaskCompletedEvent;
use App\Domain\Exception\SubTaskException;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use Illuminate\Contracts\Events\Dispatcher;

final readonly class CompleteASubTaskCommandHandler
{
    public function __construct(
        private SubTaskRepository $subTaskRepository,
        private Dispatcher        $dispatcher,
    )
    {
    }

    /**
     * @throws SubTaskException
     */
    public function __invoke(CompleteASubTaskCommand $command): void
    {
        $subTask = $this->subTaskRepository->findByID($command->id);
        if (is_null($subTask)) {
            throw SubTaskException::invalidID();
        }

        $subTask->complete();

        $this->subTaskRepository->save($subTask);

        $this->dispatcher->dispatch(new SubTaskCompletedEvent($subTask));
    }
}
