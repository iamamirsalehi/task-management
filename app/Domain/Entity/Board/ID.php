<?php

namespace App\Domain\Entity\Board;

use App\Domain\Exception\BoardException;

final readonly class ID
{
    /**
     * @throws BoardException
     */
    public function __construct(private int $id)
    {
        if ($this->id <= 0) {
            throw BoardException::invalidID();
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
