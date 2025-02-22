<?php

namespace App\Application\Command;

use App\Application\CommandHandler\AssignDeadlineToATaskCommandHandler;
use App\Domain\Entity\Task\Deadline;
use App\Domain\Entity\Task\ID;

/**
 * @see AssignDeadlineToATaskCommandHandler
 * */
final readonly class AssignDeadlineToATaskCommand
{
    public function __construct(public ID $id, public Deadline $deadline)
    {
    }
}
