<?php

namespace App\Domain\Entity\Task;

use Assert\Assert;

final readonly class Description
{
    public function __construct(private string $description)
    {
        Assert::that($this->description)->notEmpty()->maxLength(500);
    }

    public function toPrimitiveType(): string
    {
        return $this->description;
    }

    public function __toString(): string
    {
        return $this->description;
    }
}
