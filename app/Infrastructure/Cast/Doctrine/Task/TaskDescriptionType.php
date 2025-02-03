<?php

namespace App\Infrastructure\Cast\Doctrine\Task;

use App\Domain\Entity\Task\Description;
use App\Domain\Exception\TaskException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class TaskDescriptionType extends StringType
{
    private const NAME = 'description';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (is_null($value)) {
            return null;
        }

        if (!$value instanceof Description) {
            throw new \InvalidArgumentException('task description should be instance of Description');
        }

        return $value->toPrimitiveType();
    }

    /**
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Description
    {
        if (is_null($value)) {
            return null;
        }

        return new Description($value);
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getClobTypeDeclarationSQL($fieldDeclaration);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
