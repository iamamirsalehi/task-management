<?php

namespace App\Application\Command;

use App\Application\CommandHandler\StartATaskCommandHandler;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\User\ID as UserID;

/**
 * @see StartATaskCommandHandler
 * */
final readonly class StartATaskCommand
{
    public function __construct(public ID $id, public UserID $userID)
    {
    }
}
