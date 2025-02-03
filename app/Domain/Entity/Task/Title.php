<?php

namespace App\Domain\Entity\Task;

use Assert\Assert;

final readonly class Title
{
    public function __construct(private string $title)
    {
        Assert::that($this->title)->notEmpty()->minLength(5)->maxLength(100);
    }

    public function toPrimitiveType(): string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
