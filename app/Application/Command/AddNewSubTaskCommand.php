<?php

namespace App\Application\Command;

use App\Domain\Entity\SubTask\Description;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\SubTask\Title;
use App\Domain\Entity\User\ID as UserID;

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
