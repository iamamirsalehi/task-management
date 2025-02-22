<?php

namespace App\Domain\Entity\Task;

use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\User\ID as UserID;
use App\Domain\Enum\TaskPriority;
use App\Domain\Enum\TaskStatus;
use App\Domain\Exception\BusinessException;
use App\Domain\Exception\TaskException;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tasks')]
#[ORM\HasLifecycleCallbacks]
final class Task
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

    #[ORM\Column(name: 'status', type: 'task_status')]
    private TaskStatus $status;

    #[ORM\Column(name: 'priority', type: 'task_priority')]
    private TaskPriority $priority;

    #[ORM\Column(name: 'board_id', type: 'board_id')]
    private BoardID $boardID;

    #[ORM\Column(name: 'owner_id', type: 'user_id')]
    private UserID $ownerID;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime')]
    private \DateTime $updatedAt;

    /**
     * @throws TaskException
     * @throws \Exception
     */
    public function __construct(
        Title               $title,
        BoardID             $boardID,
        UserID              $ownerID,
        ?Description        $description = null,
        ?Deadline           $deadline = null,
        ?\DateTimeImmutable $now = null,
    )
    {
        $this->title = $title;
        $this->boardID = $boardID;
        $this->ownerID = $ownerID;
        $this->description = $description;
        $this->status = TaskStatus::NotStarted;
        $this->priority = TaskPriority::Medium;

        if (!is_null($deadline) && is_null($now)) {
            throw TaskException::nowIsRequired();
        }

        if (!is_null($deadline) && !is_null($now) && !$deadline->isGreaterThan($now)) {
            throw TaskException::invalidDeadline();
        }

        if (!is_null($deadline) && !is_null($now) && $deadline->isGreaterThan($now)) {
            $this->deadline = $deadline;
        }
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

    public function getPriority(): TaskPriority
    {
        return $this->priority;
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

    /**
     * @throws TaskException
     */
    public function start(): void
    {
        if (!$this->isNotStarted()) {
            throw TaskException::taskMustBeNoStarted();
        }

        $this->status = TaskStatus::InProgress;
    }

    /**
     * @throws TaskException
     */
    public function complete(): void
    {
        if (!$this->isInProgress()) {
            throw TaskException::taskMustBeInProgress();
        }

        $this->status = TaskStatus::Completed;
    }

    /**
     * @throws TaskException
     */
    public function toInProgress(): void
    {
        if ($this->isInProgress()) {
            throw TaskException::taskAlreadyIsInProgress();
        }

        $this->status = TaskStatus::InProgress;
    }

    public function isInProgress(): bool
    {
        return $this->status == TaskStatus::InProgress;
    }

    public function isCompleted(): bool
    {
        return $this->status == TaskStatus::Completed;
    }

    public function isNotStarted(): bool
    {
        return $this->status == TaskStatus::NotStarted;
    }

    /**
     * @throws TaskException
     */
    public function changeToNotStarted(): void
    {
        if ($this->isNotStarted()) {
            throw TaskException::taskIsAlreadyNotStarted();
        }

        $this->status = TaskStatus::NotStarted;
    }

    /**
     * @throws TaskException
     */
    public function reopen(): void
    {
        if (!$this->isCompleted()) {
            throw TaskException::taskMustBeCompleted();
        }

        $this->status = TaskStatus::NotStarted;
    }

    /**
     * @throws TaskException
     */
    public function changePriority(TaskPriority $priority): void
    {
        if (!$this->isNotStarted() && !$this->isInProgress()) {
            throw TaskException::taskMustBeInProgressOrNotStartedToChangeThePriority();
        }

        $this->priority = $priority;
    }

    public function changeDeadline(Deadline $deadline): void
    {
        $this->deadline = $deadline;
    }
}
