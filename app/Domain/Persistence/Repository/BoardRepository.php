<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Entity\Board\Board;
use App\Domain\Entity\Board\Name;

interface BoardRepository
{
    public function findByName(Name $name): ?Board;

    public function save(Board $board): void;
}
