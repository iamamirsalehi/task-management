<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use App\Domain\Entity\Board\Board;
use App\Domain\Entity\Board\Name;
use App\Domain\Persistence\Repository\BoardRepository;

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
}
