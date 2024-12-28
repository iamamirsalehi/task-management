<?php

namespace App\Infrastructure\Cast\Doctrine\Task;

use App\Domain\Entity\Task\Title;
use App\Domain\Exception\TaskException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class TaskTitleType extends StringType
{
    private const NAME = 'title';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof Title) {
            throw new \InvalidArgumentException('task title should be instance of Title');
        }

        return $value->toPrimitiveType();
    }

    /**
     * @throws TaskException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): Title
    {
        return new Title($value);
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($fieldDeclaration);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
