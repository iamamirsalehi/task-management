<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use App\Domain\Entity\Task\Task;
use App\Domain\Persistence\Repository\TaskRepository;

class DoctrineTaskRepository extends DoctrineBaseRepository implements TaskRepository
{
    public function save(Task $task): void
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}
