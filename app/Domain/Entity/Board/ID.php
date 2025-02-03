<?php

namespace App\Domain\Entity\Board;

use Assert\Assert;

final readonly class ID
{
    public function __construct(private int $id)
    {
        Assert::that($this->id)->min(1);
    }

    public function toPrimitiveType(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return (string)$this->id;
    }
}
