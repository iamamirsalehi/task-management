<?php

namespace App\Domain\Enums;

enum TaskPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Critical = 'critical';

    public static function getValuesAsArray(): array
    {
        return [
            self::Low->value,
            self::Medium->value,
            self::High->value,
            self::Critical->value,
        ];
    }
}
