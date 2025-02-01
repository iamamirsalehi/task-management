<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use App\Domain\Persistence\Repository\Transaction;

class DoctrineTransaction extends DoctrineBaseRepository implements Transaction
{
    public function warp(callable $callable): void
    {
        try {
            $this->entityManager->beginTransaction();

            $callable();

            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
        }
    }
}
