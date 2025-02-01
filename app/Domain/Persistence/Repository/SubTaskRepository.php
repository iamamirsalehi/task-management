<?php

namespace App\Domain\Persistence\Repository;

use App\Domain\Entity\Enums\SubTaskStatus;
use App\Domain\Entity\SubTask\ID;
use App\Domain\Entity\Task\ID as TaskID;
use App\Domain\Entity\SubTask\SubTask;
use Illuminate\Support\Collection;

interface SubTaskRepository
{
    public function findByID(ID $id): ?SubTask;

    public function save(SubTask $subTask): void;

    public function getByParentID(TaskID $parentID): Collection;

    public function countByParentID(TaskID $parentID): int;

    public function countByParentIDAndStatus(TaskID $parentID, SubTaskStatus $status): int;

    public function remove(SubTask $subTask): void;
}
