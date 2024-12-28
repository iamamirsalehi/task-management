<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Entity\Task\Task;

interface TaskRepository
{
    public function save(Task $task): void;
}
