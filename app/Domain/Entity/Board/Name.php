<?php

namespace App\Domain\Entity\Board;

use App\Domain\Exception\BoardException;

final readonly class Name
{
    /**
     * @throws BoardException
     */
    public function __construct(private string $name)
    {
        if (empty($this->name)) {
            throw BoardException::invalidName();
        }

        $nameLen = strlen($this->name);
        if ($nameLen < 3 || $nameLen > 50) {
            throw BoardException::invalidName();
        }
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
