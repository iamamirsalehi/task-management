<?php

namespace App\Domain\Entity\Board;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\User\ID as UserID;

#[ORM\Entity]
#[ORM\Table(name: 'boards')]
#[ORM\HasLifecycleCallbacks]
final class Board
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'board_id')]
    private ID $id;

    #[ORM\Column(name: 'name', type: 'board_name', length: 50)]
    private Name $name;

    #[ORM\Column(name: 'description', type: 'board_description', length: 200, nullable: true)]
    private ?Description $description = null;

    #[ORM\Column(name: 'owner_id', type: 'user_id')]
    private UserID $ownerID;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct(
        Name         $name,
        UserID       $ownerID,
        ?Description $description = null
    )
    {
        $this->name = $name;
        $this->ownerID = $ownerID;
        $this->description = $description;
    }

    public function getId(): ID
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $now = new \DateTimeImmutable('now');
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $now = new \DateTimeImmutable('now');
        $this->updatedAt = $now;
    }
}
