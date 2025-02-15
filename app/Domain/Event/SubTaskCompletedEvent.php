<?php

namespace App\Domain\Event;

use App\Domain\Entity\SubTask\SubTask;
use Illuminate\Foundation\Bus\Dispatchable;

final readonly class SubTaskCompletedEvent
{
    //TODO: Should not depend on framework
    use Dispatchable;

    public function __construct(public SubTask $subTask)
    {

    }
    public function handle(): void
    {

    }
}
