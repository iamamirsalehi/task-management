<?php

namespace App\Domain\Entity\Enums;

enum SubTaskStatus: string
{
    case NotStarted = 'not-started';
    case InProgress = 'in-progress';
    case Completed = 'completed';
}
