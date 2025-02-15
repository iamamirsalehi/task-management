<?php

namespace App\Application\Command;

use App\Domain\Entity\Task\ID;
use App\Domain\Enum\TaskPriority;

final readonly class PrioritizeATaskCommand
{
    public function __construct(public ID $id, public TaskPriority $priority)
    {
    }
}
