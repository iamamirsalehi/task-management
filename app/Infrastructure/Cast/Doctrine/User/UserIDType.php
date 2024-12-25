<?php

namespace App\Infrastructure\Cast\Doctrine\User;

use App\Domain\Entity\User\ID;
use App\Domain\Exception\UserException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class UserIDType extends Type
{
    private const NAME = 'id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        if (!$value instanceof ID) {
            throw new \InvalidArgumentException('value must be an instance of Board ID');
        }
        return $value->toPrimitiveType();
    }

    /**
     * @throws UserException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ID
    {
        return new ID($value);
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
