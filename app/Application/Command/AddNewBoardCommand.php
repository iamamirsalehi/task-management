<?php

namespace App\Application\Command;

use App\Application\CommandHandler\AddNewBoardCommandHandler;
use App\Domain\Entity\Board\Description;
use App\Domain\Entity\Board\Name;
use App\Domain\Entity\User\ID as UserID;

/**
 * @see AddNewBoardCommandHandler
 * */
final readonly class AddNewBoardCommand
{
    public function __construct(
        private Name         $name,
        private UserID       $ownerID,
        private ?Description $description = null,
    )
    {
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getOwnerID(): UserID
    {
        return $this->ownerID;
    }
}
