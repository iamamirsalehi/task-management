<?php

namespace App\Application\Services\TaskService;

use App\Domain\Entity\Task\ID;
use App\Domain\Enums\SubTaskStatus;
use App\Domain\Persistence\Repository\SubTaskRepository;

final readonly class TaskService
{
    public function __construct(private SubTaskRepository $subTaskRepository)
    {
    }

    public function areAllSubTasksCompleted(ID $taskID): bool
    {
        return $this->subTaskRepository->countByParentID($taskID)
            == $this->subTaskRepository->countByParentIDAndStatus($taskID, SubTaskStatus::Completed);
    }
}
