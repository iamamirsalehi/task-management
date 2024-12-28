<?php

namespace App\Domain\Entity\Task;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Entity\Board\ID as BoardID;

#[ORM\Entity]
#[ORM\Table(name: 'tasks')]
#[ORM\HasLifecycleCallbacks]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'task_id')]
    private ID $id;

    #[ORM\Column(name: 'title', type: 'task_title', length: 255)]
    private Title $title;

    #[ORM\Column(name: 'description', type: 'task_description', length: 500, nullable: true)]
    private ?Description $description = null;

    #[ORM\Column(name: 'deadline', type: 'task_deadline', nullable: true)]
    private ?Deadline $deadline = null;

    #[ORM\Column(name: 'board_id', type: 'board_id')]
    private BoardID $boardID;

    #[ORM\Column(name: 'user_id', type: 'user_id')]
    private UserID $userID;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime')]
    private \DateTime $updatedAt;

    public function __construct(Title $title, BoardID $boardID, UserID $userID)
    {
        $this->title = $title;
        $this->boardID = $boardID;
        $this->userID = $userID;
    }

    public function getId(): ID
    {
        return $this->id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function setDescription(Description $description): void
    {
        $this->description = $description;
    }

    public function getDeadline(): ?Deadline
    {
        return $this->deadline;
    }

    public function setDeadline(Deadline $deadline): void
    {
        $this->deadline = $deadline;
    }

    public function getBoardID(): BoardID
    {
        return $this->boardID;
    }

    public function getUserID(): UserID
    {
        return $this->userID;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $now = new \DateTime('now');
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $now = new \DateTime('now');
        $this->updatedAt = $now;
    }
}
