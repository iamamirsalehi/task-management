<?php

namespace App\Application\Command;

use App\Application\CommandHandler\AddNewSubTaskCommandHandler;
use App\Domain\Entity\SubTask\Description;
use App\Domain\Entity\Task\ID;
use App\Domain\Entity\SubTask\Title;

/**
 * @see AddNewSubTaskCommandHandler
 * */
final readonly class AddNewSubTaskCommand
{
    public function __construct(
        public Title       $title,
        public ID          $parentID,
        public ?Description $description = null,
    )
    {
    }
}
