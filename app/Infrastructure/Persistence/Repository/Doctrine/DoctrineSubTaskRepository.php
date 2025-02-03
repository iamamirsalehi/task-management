<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use App\Domain\Entity\SubTask\ID;
use App\Domain\Entity\SubTask\SubTask;
use App\Domain\Entity\Task\ID as TaskID;
use App\Domain\Enums\SubTaskStatus;
use App\Domain\Persistence\Repository\SubTaskRepository;
use Illuminate\Support\Collection;

class DoctrineSubTaskRepository extends DoctrineBaseRepository implements SubTaskRepository
{
    public function findByID(ID $id): ?SubTask
    {
        return $this->entityManager->createQueryBuilder()
            ->select('s')
            ->from(SubTask::class, 's')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(SubTask $subTask): void
    {
        $this->entityManager->persist($subTask);
        $this->entityManager->flush();
    }

    public function getByParentID(TaskID $parentID): Collection
    {
        $subTasks = $this->entityManager->createQueryBuilder()
            ->select('s')
            ->from(SubTask::class, 's')
            ->where('s.parentID = :parentID')
            ->setParameter('parentID', $parentID)
            ->getQuery();

        return new Collection($subTasks);
    }

    public function countByParentID(TaskID $parentID): int
    {
        return $this->entityManager->createQueryBuilder()
            ->select('COUNT(s)')
            ->from(SubTask::class, 's')
            ->where('s.parentID = :parentID')
            ->setParameter('parentID', $parentID)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByParentIDAndStatus(TaskID $parentID, SubTaskStatus $status): int
    {
        return $this->entityManager->createQueryBuilder()
            ->select('COUNT(s)')
            ->from(SubTask::class, 's')
            ->where('s.parentID = :parent_id AND s.status = :status')
            ->setParameter('parent_id', $parentID)
            ->setParameter('status', $status)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function remove(SubTask $subTask): void
    {
        $this->entityManager->createQueryBuilder()
            ->delete(SubTask::class, 's')
            ->where('s.id = :id')
            ->setParameter('id', $subTask->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }
}
