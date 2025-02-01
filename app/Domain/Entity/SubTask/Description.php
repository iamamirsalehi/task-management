<?php

namespace App\Domain\Entity\SubTask;

use App\Domain\Exception\SubTaskException;

final class Description
{
    /**
     * @throws SubTaskException
     */
    public function __construct(private string $description)
    {
        if (strlen($this->description) > 500) {
            throw SubTaskException::invalidDescription();
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
