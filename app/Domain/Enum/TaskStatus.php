<?php

namespace App\Domain\Enum;

enum TaskStatus: string
{
    case NotStarted = 'not-started';
    case InProgress = 'in-progress';
    case Completed = 'completed';

    public static function getValuesAsArray(): array
    {
        return [
            self::NotStarted->value,
            self::InProgress->value,
            self::Completed->value,
        ];
    }
}
