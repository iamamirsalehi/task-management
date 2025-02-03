<?php

namespace App\Domain\Entity\Board;

use Assert\Assert;

final readonly class Name
{
    public function __construct(private string $name)
    {
        Assert::that($name)->notEmpty()->minLength(3)->maxLength(50);
    }

    public function toPrimitiveType(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
