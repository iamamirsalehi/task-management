<?php

namespace App\Domain\Event;

use App\Domain\Entity\SubTask\SubTask;
use App\Domain\Entity\Task\Task;
use Illuminate\Foundation\Bus\Dispatchable;

final readonly class SubTaskReopenedEvent
{
    use Dispatchable;

    public function __construct(public Task $parentTask)
    {
    }

    public function handle(): void
    {

    }
}
