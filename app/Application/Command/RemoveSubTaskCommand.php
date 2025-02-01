<?php

namespace App\Application\Command;

use App\Domain\Entity\SubTask\ID;

final readonly class RemoveSubTaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
