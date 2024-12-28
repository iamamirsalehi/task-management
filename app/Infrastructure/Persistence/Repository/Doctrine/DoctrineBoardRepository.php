<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use App\Domain\Entity\Board\Board;
use App\Domain\Entity\Board\ID;
use App\Domain\Entity\Board\Name;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Persistence\Repository\BoardRepository;
use Illuminate\Support\Collection;

class DoctrineBoardRepository extends DoctrineBaseRepository implements BoardRepository
{
    public function save(Board $board): void
    {
        $this->entityManager->persist($board);
        $this->entityManager->flush();
    }

    public function findByName(Name $name): ?Board
    {
        return $this->entityManager->createQueryBuilder()
            ->select('b')
            ->from(Board::class, 'b')
            ->where('b.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getByUserID(UserID $id): Collection
    {
        $boards = $this->entityManager->createQueryBuilder()
            ->select('b')
            ->from(Board::class, 'b')
            ->where('b.userID = :user_id')
            ->setParameter('user_id', $id)
            ->getQuery()
            ->getResult();

        return new Collection($boards);
    }

    public function findByID(ID $id): ?Board
    {
        return $this->entityManager->createQueryBuilder()
            ->select('b')
            ->from(Board::class, 'b')
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
