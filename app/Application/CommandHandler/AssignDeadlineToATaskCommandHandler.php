<?php

namespace App\Application\CommandHandler;

use App\Application\Command\AssignDeadlineToATaskCommand;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\TaskRepository;

final readonly class AssignDeadlineToATaskCommandHandler
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(AssignDeadlineToATaskCommand $command): void
    {
        $task = $this->taskRepository->findByID($command->id);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        $task->changeDeadline($command->deadline, new \DateTimeImmutable('now'));

        $this->taskRepository->save($task);
    }
}
