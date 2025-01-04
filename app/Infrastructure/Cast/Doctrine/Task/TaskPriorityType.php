<?php

namespace App\Infrastructure\Cast\Doctrine\Task;

use App\Domain\Entity\Enums\TaskPriority;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TaskPriorityType extends Type
{
    private const NAME = 'priority';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): TaskPriority
    {
        return TaskPriority::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof TaskPriority) {
            throw new \InvalidArgumentException('task priority must be instance of TaskPriority');
        }

        return $value->value;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
