<?php

namespace App\Domain\Event;

use App\Domain\Entity\Task\Task;
use Illuminate\Foundation\Events\Dispatchable;

final readonly class SubTaskRemovedEvent
{
    use Dispatchable;

    public function __construct(public Task $parentTask)
    {
    }

    public function handle(): void
    {
    }
}
