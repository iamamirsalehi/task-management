<?php

namespace App\Application\Query;

use App\Application\QueryHandler\GetAllUserBoardsQueryHandler;
use App\Domain\Entity\User\ID;

/**
 * @see GetAllUserBoardsQueryHandler
 * */
final readonly class GetAllUserBoardsQuery
{
    public function __construct(public ID $userID)
    {

    }
}
