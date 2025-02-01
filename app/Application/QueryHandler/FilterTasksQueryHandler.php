<?php

namespace App\Application\QueryHandler;

use App\Application\Query\FilterTasksQuery;
use App\Domain\Persistence\Repository\FilterTasksData;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Support\Collection;

final readonly class FilterTasksQueryHandler
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function __invoke(FilterTasksQuery $filterTasksQuery): Collection
    {
        $filterTaskData = new FilterTasksData();

        if ($filterTasksQuery->getPriority()) {
            $filterTaskData->setPriority($filterTasksQuery->getPriority());
        }

        if ($filterTasksQuery->getStatus()) {
            $filterTaskData->setStatus($filterTasksQuery->getStatus());
        }

        return $this->taskRepository->filter($filterTaskData);
    }
}
