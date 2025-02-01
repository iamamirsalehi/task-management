<?php

namespace App\Application\Command;

use App\Domain\Entity\SubTask\ID;

final readonly class StartSubTaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
