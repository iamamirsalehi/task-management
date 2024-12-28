<?php

namespace App\Domain\Entity\Task;

use App\Domain\Exception\TaskException;

final readonly class ID
{
    /**
     * @throws TaskException
     */
    public function __construct(private int $id)
    {
        if ($this->id <= 0) {
            throw TaskException::invalidID();
        }
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
