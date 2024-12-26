<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Entity\Board\Board;
use App\Domain\Entity\Board\Name;
use App\Domain\Entity\User\ID as UserID;
use Illuminate\Support\Collection;

interface BoardRepository
{
    public function findByName(Name $name): ?Board;

    public function save(Board $board): void;

    public function getByUserID(UserID $id): Collection;
}
