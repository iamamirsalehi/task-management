<?php

namespace App\Domain\Enum;

enum SubTaskStatus: string
{
    case NotStarted = 'not-started';
    case InProgress = 'in-progress';
    case Completed = 'completed';
}
