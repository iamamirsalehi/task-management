<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Enums\TaskPriority;
use App\Domain\Enums\TaskStatus;

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
