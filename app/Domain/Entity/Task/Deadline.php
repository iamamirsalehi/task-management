<?php

namespace App\Domain\Entity\Task;

use Assert\Assert;

final readonly class Deadline
{
    public function __construct(private string $deadline)
    {
        Assert::that($this->deadline)->greaterThan(new \DateTime('now'));
    }

    public function toPrimitiveType(): string
    {
        return $this->deadline;
    }

    public function __toString(): string
    {
        return $this->deadline;
    }
}
