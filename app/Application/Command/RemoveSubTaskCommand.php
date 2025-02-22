<?php

namespace App\Application\Command;

use App\Application\CommandHandler\RemoveSubTaskCommandHandler;
use App\Domain\Entity\SubTask\ID;

/**
 * @see RemoveSubTaskCommandHandler
 * */
final readonly class RemoveSubTaskCommand
{
    public function __construct(public ID $id)
    {
    }
}
