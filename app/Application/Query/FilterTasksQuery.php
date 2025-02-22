<?php

namespace App\Application\Query;

use App\Application\QueryHandler\FilterTasksQueryHandler;
use App\Domain\Enum\TaskPriority;
use App\Domain\Enum\TaskStatus;

/**
 * @see FilterTasksQueryHandler
 * */
final readonly class FilterTasksQuery
{
    public function __construct(
        private ?TaskStatus   $status = null,
        private ?TaskPriority $priority = null,
    )
    {

    }

    public function getStatus(): ?TaskStatus
    {
        return $this->status;
    }

    public function getPriority(): ?TaskPriority
    {
        return $this->priority;
    }
}
