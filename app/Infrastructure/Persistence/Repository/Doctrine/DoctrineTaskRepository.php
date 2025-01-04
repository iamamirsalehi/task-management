<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\Task\Task;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Persistence\Repository\TaskRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Illuminate\Support\Collection;

class DoctrineTaskRepository extends DoctrineBaseRepository implements TaskRepository
{
    public function save(Task $task): void
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function getAllByUserIDAndBoardID(UserID $userID, BoardID $boardID): Collection
    {
        $tasks = $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Task::class, 't')
            ->where('t.userID = :user_id AND t.boardID = :board_id')
            ->setParameter('user_id', $userID)
            ->setParameter('board_id', $boardID)
            ->getQuery()
            ->getResult();

        return new Collection($tasks);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function findByID(ID $id): ?Task
    {
        return $this->entityManager->find(Task::class, $id);
    }
}
