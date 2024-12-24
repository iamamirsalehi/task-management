<?php

namespace App\Domain\Entity\User;

use App\Domain\Exception\UserException;

final readonly class UserID
{
    /**
     * @throws UserException
     */
    public function __construct(private int $id)
    {
        if ($this->id <= 0) {
            throw UserException::invalidUserID();
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
