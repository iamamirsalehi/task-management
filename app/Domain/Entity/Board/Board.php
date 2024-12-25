<?php

namespace App\Domain\Entity\Board;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\User\ID as UserID;

#[ORM\Entity]
#[ORM\Table(name: 'boards')]
#[ORM\HasLifecycleCallbacks]
class Board
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'board_id')]
    private ID $id;

    #[ORM\Column(name: 'name', type: 'board_name', length: 50)]
    private Name $name;

    #[ORM\Column(name: 'description', type: 'board_description', length: 200, nullable: true)]
    private Description $description;

    #[ORM\Column(name: 'user_id', type: 'user_id')]
    private UserID $userID;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: true)]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    private ?\DateTime $updatedAt = null;

    public function __construct(Name $name, UserID $userID)
    {
        $this->name = $name;
        $this->userID = $userID;
    }

    public function getId(): ID
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setDescription(Description $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): Description
    {
        return $this->description;
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
