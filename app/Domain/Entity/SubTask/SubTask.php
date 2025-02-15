<?php

namespace App\Domain\Entity\SubTask;

use App\Domain\Entity\Task\ID as TaskID;
use App\Domain\Enum\SubTaskStatus;
use App\Domain\Exception\SubTaskException;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'sub_tasks')]
#[ORM\HasLifecycleCallbacks]
final class SubTask
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'subtask_id', nullable: false)]
    private ID $id;

    #[ORM\Column(name: 'title', type: 'subtask_title', length: 100)]
    private Title $title;

    #[ORM\Column(name: 'description', type: 'subtask_description', length: 500)]
    private Description $description;

    #[ORM\Column(name: 'status', type: 'subtask_status')]
    private SubTaskStatus $status;

    #[ORM\Column(name: 'parent_id', type: 'task_id', nullable: false)]
    private TaskID $parentID;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private \DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime')]
    private \DateTime $updatedAt;


    public function __construct(Title $title, Description $description, TaskID $parentID)
    {
        $this->title = $title;
        $this->description = $description;
        $this->parentID = $parentID;
        $this->status = SubTaskStatus::NotStarted;
    }

    public function getId(): ID
    {
        return $this->id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getStatus(): SubTaskStatus
    {
        return $this->status;
    }

    public function getParentID(): TaskID
    {
        return $this->parentID;
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
     * @throws SubTaskException
     */
    public function start(): void
    {
        if (!$this->isNotStarted()) {
            throw SubTaskException::canNotStartSubTask();
        }

        $this->status = SubTaskStatus::InProgress;
    }

    /**
     * @throws SubTaskException
     */
    public function complete(): void
    {
        if (!$this->isInProgress()) {
            throw SubTaskException::canNotCompleteSubTask();
        }

        $this->status = SubTaskStatus::Completed;
    }

    public function isInProgress(): bool
    {
        return $this->status == SubTaskStatus::InProgress;
    }

    public function isCompleted(): bool
    {
        return $this->status == SubTaskStatus::Completed;
    }

    public function isNotStarted(): bool
    {
        return $this->status == SubTaskStatus::NotStarted;
    }

    /**
     * @throws SubTaskException
     */
    public function reopen(): void
    {
        if (!$this->isNotStarted() && !$this->isCompleted()) {
            throw SubTaskException::canNotReopenSubTask();
        }

        $this->status = SubTaskStatus::NotStarted;
    }
}
