<?php

namespace App\Application\Command;

use App\Domain\Entity\Task\Deadline;
use App\Domain\Entity\Task\ID;

final readonly class AssignDeadlineToATaskCommand
{
    public function __construct(public ID $id, public Deadline $deadline)
    {
    }
}
