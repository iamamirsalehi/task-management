<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Entity\User\User;

interface UserRepository
{
    public function save(User $user): void;
}
