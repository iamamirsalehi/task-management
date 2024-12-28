<?php

namespace App\Application\Query;

use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\User\ID as UserID;

final readonly class GetBoardTasksQuery
{
    public function __construct(
        public BoardID $boardID,
        public UserID  $userID,
    )
    {
    }
}
