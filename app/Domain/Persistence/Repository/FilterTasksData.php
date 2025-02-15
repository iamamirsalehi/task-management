<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Enum\TaskPriority;
use App\Domain\Enum\TaskStatus;

final class FilterTasksData
{
    private ?TaskStatus $status = null;
    private ?TaskPriority $priority = null;

    public function setStatus(TaskStatus $status): void
    {
        $this->status = $status;
    }

    public function setPriority(TaskPriority $priority): void
    {
        $this->priority = $priority;
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
