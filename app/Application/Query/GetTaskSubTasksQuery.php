<?php

namespace App\Application\Query;

use App\Domain\Entity\Task\ID;

final readonly class GetTaskSubTasksQuery
{
    public function __construct(public ID $id)
    {
    }
}
