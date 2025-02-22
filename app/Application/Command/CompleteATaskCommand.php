<?php

namespace App\Application\Command;

use App\Application\CommandHandler\CompleteATaskCommandHandler;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\User\ID as UserID;

/**
 * @see CompleteATaskCommandHandler
 * */
final readonly class CompleteATaskCommand
{
    public function __construct(public ID $id, public UserID $userID)
    {
    }
}
