<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Entity\Task\Task;
use Illuminate\Support\Collection;

interface TaskRepository
{
    public function save(Task $task): void;

    public function getAllByUserIDAndBoardID(UserID $userID, BoardID $boardID): Collection;

    public function findByID(ID $id): ?Task;
}
