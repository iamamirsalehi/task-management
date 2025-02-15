<?php

namespace App\Infrastructure\Cast\Doctrine\SubTask;

use App\Domain\Enum\SubTaskStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class SubTaskStatusType extends Type
{
    private const NAME = 'status';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof SubTaskStatus) {
            throw new \InvalidArgumentException('sub task status must be instance of SubTaskStatus');
        }

        return $value->value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): SubTaskStatus
    {
        return SubTaskStatus::from($value);
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
