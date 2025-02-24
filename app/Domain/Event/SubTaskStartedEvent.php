<?php

namespace App\Domain\Event;

use App\Domain\Entity\Task\Task;
use Illuminate\Foundation\Events\Dispatchable;

final readonly class SubTaskStartedEvent
{
    use Dispatchable;

    public function __construct(public Task $task)
    {
    }

    public function handle(): void
    {

    }
}
