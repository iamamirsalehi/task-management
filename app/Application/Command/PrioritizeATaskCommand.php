<?php

namespace App\Application\Command;

use App\Application\CommandHandler\PrioritizeATaskCommandHandler;
use App\Domain\Entity\Task\ID;
use App\Domain\Enum\TaskPriority;

/**
 * @see PrioritizeATaskCommandHandler
 * */
final readonly class PrioritizeATaskCommand
{
    public function __construct(public ID $id, public TaskPriority $priority)
    {
    }
}
