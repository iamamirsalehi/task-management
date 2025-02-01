<?php

namespace App\Infrastructure\Cast\Doctrine\SubTask;

use App\Domain\Entity\SubTask\Title;
use App\Domain\Exception\SubTaskException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class SubTaskTitleType extends StringType
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
     * @throws SubTaskException
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
