<?php

namespace App\Application\Command;

use App\Domain\Entity\Board\Description;
use App\Domain\Entity\Board\Name;
use App\Domain\Entity\User\ID as UserID;

final class AddNewBoardCommand
{
    private Description $description;

    public function __construct(private Name $name, private UserID $userID)
    {
    }

    public function setDescription(Description $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getUserID(): UserID
    {
        return $this->userID;
    }
}
