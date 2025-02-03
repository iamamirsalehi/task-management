<?php

namespace App\Infrastructure\Cast\Doctrine\Task;

use App\Domain\Entity\Task\ID;
use App\Domain\Exception\TaskException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TaskIDType extends Type
{
    private const NAME = 'id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        if (!$value instanceof ID) {
            throw new \InvalidArgumentException('task id should be instance of ID');
        }

        return $value->toPrimitiveType();
    }

    /**
     * @throws TaskException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ID
    {
        return new ID($value);
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($fieldDeclaration);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
