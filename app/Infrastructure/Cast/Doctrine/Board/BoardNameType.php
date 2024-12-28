<?php

namespace App\Infrastructure\Cast\Doctrine\Board;

use App\Domain\Entity\Board\Name;
use App\Domain\Exception\BoardException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class BoardNameType extends StringType
{
    private const NAME = 'name';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof Name) {
            throw new \InvalidArgumentException('board name should be instance of Name');
        }

        return $value->toPrimitiveType();
    }

    /**
     * @throws BoardException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): Name
    {
        return new Name($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
