<?php

namespace App\Application\Query;

use App\Domain\Entity\User\ID;

final readonly class GetAllUserBoardsQuery
{
    public function __construct(public ID $userID)
    {

    }
}
