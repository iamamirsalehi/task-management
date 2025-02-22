<?php

namespace App\Application\Query;

use App\Application\QueryHandler\GetTaskSubTasksQueryHandler;
use App\Domain\Entity\Task\ID;

/**
 * @see GetTaskSubTasksQueryHandler
 * */
final readonly class GetTaskSubTasksQuery
{
    public function __construct(public ID $id)
    {
    }
}
