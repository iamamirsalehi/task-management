<?php

namespace App\Application\QueryHandler;

use App\Application\Query\GetTaskSubTasksQuery;
use App\Domain\Exception\TaskException;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Support\Collection;

final readonly class GetTaskSubTasksQueryHandler
{
    public function __construct(
        private TaskRepository    $taskRepository,
        private SubTaskRepository $subTaskRepository,
    )
    {
    }

    /**
     * @throws TaskException
     */
    public function __invoke(GetTaskSubTasksQuery $query): Collection
    {
        $task = $this->taskRepository->findByID($query->id);
        if (is_null($task)) {
            throw TaskException::invalidID();
        }

        return $this->subTaskRepository->getByParentID($task->getId());
    }
}
