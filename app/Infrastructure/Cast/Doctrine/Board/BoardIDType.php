<?php

namespace App\Infrastructure\Cast\Doctrine\Board;

use App\Domain\Entity\Board\ID;
use App\Domain\Exception\BoardException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class BoardIDType extends Type
{
    private const NAME = 'id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        if(!$value instanceof ID){
            throw new \InvalidArgumentException('invalid board id type');
        }
        return $value->toPrimitiveType()    ;
    }

    /**
     * @throws BoardException
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
