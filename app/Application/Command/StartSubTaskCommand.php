<?php

namespace App\Application\Command;

use App\Application\CommandHandler\StartSubTaskCommandHandler;
use App\Domain\Entity\SubTask\ID;

/**
 * @see StartSubTaskCommandHandler
 * */
final readonly class StartSubTaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
