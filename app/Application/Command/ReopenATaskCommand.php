<?php

namespace App\Application\Command;

use App\Application\CommandHandler\ReopenATaskCommandHandler;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\User\ID as UserID;

/**
 * @see ReopenATaskCommandHandler
 * */
final readonly class ReopenATaskCommand
{
    public function __construct(public ID $id, public UserID $userID)
    {
    }
}
