<?php

namespace App\Domain\Entity\Enums;

enum TaskStatus: string
{
    case NotStarted = 'not-started';
    case InProgress = 'in-progress';
    case Completed = 'completed';
}
