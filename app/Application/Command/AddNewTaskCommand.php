<?php

namespace App\Application\Command;

use App\Application\CommandHandler\AddNewTaskCommandHandler;
use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Entity\Task\Deadline;
use App\Domain\Entity\Task\Description;
use App\Domain\Entity\Task\Title;

/**
 * @see AddNewTaskCommandHandler
 * */
final readonly class AddNewTaskCommand
{


    public function __construct(
        private Title        $title,
        private BoardID      $boardID,
        private UserID       $userID,
        private ?Description $description = null,
        private ?Deadline    $deadline = null,
    )
    {
    }

    public function getDescription(): ?Description
    {
        return $this->description;
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
