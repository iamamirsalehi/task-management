<?php

namespace App\Application\Command;

use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Entity\Task\Deadline;
use App\Domain\Entity\Task\Description;
use App\Domain\Entity\Task\Title;

final class AddNewTaskCommand
{
    private ?Description $description = null;
    private ?Deadline $deadline = null;

    public function __construct(
        private readonly Title   $title,
        private readonly BoardID $boardID,
        private readonly UserID  $userID,
    )
    {
    }

    public function setDescription(Description $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function setDeadline(Deadline $deadline): void
    {
        $this->deadline = $deadline;
    }

    public function getDeadline(): ?Deadline
    {
        return $this->deadline;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getBoardID(): BoardID
    {
        return $this->boardID;
    }

    public function getUserID(): UserID
    {
        return $this->userID;
    }
}
