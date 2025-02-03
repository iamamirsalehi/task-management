<?php

namespace App\Infrastructure\Cast\Doctrine\SubTask;

use App\Domain\Entity\SubTask\ID;
use App\Domain\Exception\SubTaskException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class SubTaskIDType extends Type
{
    private const NAME = 'id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        if (!$value instanceof ID) {
            throw new \InvalidArgumentException('sub task id should be instance of ID');
        }

        return $value->toPrimitiveType();
    }

    /**
     * @throws SubTaskException
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
