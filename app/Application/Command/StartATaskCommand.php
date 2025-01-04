<?php

namespace App\Application\Command;

use App\Domain\Entity\Task\ID;

final readonly class StartATaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
