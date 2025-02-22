<?php

namespace App\Application\Command;

use App\Application\CommandHandler\ReopenSubTaskCommandHandler;
use App\Domain\Entity\SubTask\ID;

/**
 * @see ReopenSubTaskCommandHandler
 * */
final readonly class ReopenSubTaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
