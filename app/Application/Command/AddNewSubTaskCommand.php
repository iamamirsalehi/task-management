<?php

namespace App\Application\Command;

use App\Application\CommandHandler\AddNewSubTaskCommandHandler;
use App\Domain\Entity\SubTask\Description;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\SubTask\Title;
use App\Domain\Entity\User\ID as UserID;

/**
 * @see AddNewSubTaskCommandHandler
 * */
final readonly class AddNewSubTaskCommand
{
    public function __construct(
        public Title       $title,
        public Description $description,
        public ID          $parentID,
        public UserID      $userID,
    )
    {
    }
}
