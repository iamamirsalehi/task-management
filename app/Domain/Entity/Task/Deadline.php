<?php

namespace App\Domain\Entity\Task;

use Assert\Assert;

final readonly class Deadline
{
    public function __construct(private string $deadline)
    {
        Assert::that($this->deadline)->date('Y-m-d');
    }

    /**
     * @throws \Exception
     */
    public function isGreaterThan(\DateTimeImmutable $greaterDateTime): bool
    {
        $deadline = new \DateTimeImmutable($this->deadline);

        return $deadline->diff($greaterDateTime)->format('%a') > 0;
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
