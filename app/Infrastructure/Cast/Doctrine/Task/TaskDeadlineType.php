<?php

namespace App\Infrastructure\Cast\Doctrine\Task;

use App\Domain\Entity\Task\Deadline;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class TaskDeadlineType extends StringType
{
    private const NAME = 'deadline';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (!$value instanceof Deadline) {
            throw new \InvalidArgumentException('task deadline should be instance of Deadline');
        }

        return $value->toPrimitiveType();
    }

    /**
     * @throws \Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Deadline
    {
        if (is_null($value)) {
            return null;
        }

        return new Deadline($value);
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getDateTimeTypeDeclarationSQL($fieldDeclaration);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
