<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use App\Domain\Entity\User\User;
use App\Domain\Persistence\Repository\UserRepository;

class DoctrineUserRepository extends DoctrineBaseRepository implements UserRepository
{
    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
