<?php

namespace App\Infrastructure\Cast\Doctrine\SubTask;

use App\Domain\Entity\SubTask\Description;
use App\Domain\Exception\SubTaskException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class SubTaskDescriptionType  extends StringType
{
    private const NAME = 'description';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof Description) {
            throw new \InvalidArgumentException('task description should be instance of Description');
        }

        return $value->toPrimitiveType();
    }

    /**
     * @throws SubTaskException
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
