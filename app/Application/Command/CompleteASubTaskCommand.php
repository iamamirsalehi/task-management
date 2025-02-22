<?php

namespace App\Application\Command;

use App\Application\CommandHandler\CompleteASubTaskCommandHandler;
use App\Domain\Entity\SubTask\ID;

/**
 * @see CompleteASubTaskCommandHandler
 * */
final readonly class CompleteASubTaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
