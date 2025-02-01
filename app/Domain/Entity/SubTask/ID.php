<?php

namespace App\Domain\Entity\SubTask;

use App\Domain\Exception\SubTaskException;

final class ID
{
    /**
     * @throws SubTaskException
     */
    public function __construct(private int $id)
    {
        if ($this->id < 0) {
            throw SubTaskException::invalidID();
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
