<?php

namespace App\Domain\Entity\Board;

use App\Domain\Exception\BoardException;

final readonly class Description
{
    /**
     * @throws BoardException
     */
    public function __construct(private string $description)
    {
        if (empty($this->description)) {
            throw BoardException::invalidDescription();
        }

        if (strlen($this->description) > 200) {
            throw BoardException::invalidDescription();
        }
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
