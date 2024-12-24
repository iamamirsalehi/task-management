<?php

namespace App\Infrastructure\Cast\Doctrine;

use App\Domain\Entity\User\UserID;
use App\Domain\Exception\UserException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class UserIDType extends IntegerType
{
    private const NAME = 'id';

    /**
     * @throws UserException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return $value instanceof UserID ? $value->toPrimitiveType() : $value;
    }

    /**
     * @throws UserException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): int
    {
        return $value->toPrimitiveType();
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
