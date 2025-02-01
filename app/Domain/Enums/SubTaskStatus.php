<?php

namespace App\Domain\Enums;

enum SubTaskStatus: string
{
    case NotStarted = 'not-started';
    case InProgress = 'in-progress';
    case Completed = 'completed';
}
