<?php

namespace App\Infrastructure\Cast\Doctrine\Task;

use App\Domain\Enums\TaskStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TaskStatusType extends Type
{
    private const NAME = 'status';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof TaskStatus) {
            throw new \InvalidArgumentException('task status must be instance of TaskStatus');
        }

        return $value->value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): TaskStatus
    {
        return TaskStatus::from($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getclobTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
