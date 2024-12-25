<?php

namespace App\Infrastructure\Cast\Doctrine\Board;

use App\Domain\Entity\Board\Description;
use App\Domain\Exception\BoardException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class BoardDescriptionType extends StringType
{
    private const NAME = 'description';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (!$value instanceof Description) {
            throw new \InvalidArgumentException('value must be instance of Description');
        }
        return $value->toPrimitiveType();
    }

    /**
     * @throws BoardException
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
        return $platform->getStringTypeDeclarationSQL($fieldDeclaration);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
