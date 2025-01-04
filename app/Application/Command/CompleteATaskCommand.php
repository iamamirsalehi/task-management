<?php

namespace App\Application\Command;

use App\Domain\Entity\Task\ID;

final readonly class CompleteATaskCommand
{
    public function __construct(public ID $id)
    {

    }
}
