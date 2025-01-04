<?php

namespace App\Application\Command;

use App\Domain\Entity\Enums\TaskPriority;
use App\Domain\Entity\Task\ID;

final readonly class PrioritizeATaskCommand
{
    public function __construct(public ID $id, public TaskPriority $priority)
    {
    }
}
