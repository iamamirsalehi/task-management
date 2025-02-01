<?php

namespace App\Application\Command;

use App\Domain\Entity\SubTask\ID;

final readonly class ReopenSubTaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
