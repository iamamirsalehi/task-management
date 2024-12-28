<?php

namespace App\Domain\Entity\Task;

use App\Domain\Exception\TaskException;

final readonly class Description
{
    /**
     * @throws TaskException
     */
    public function __construct(private string $description)
    {
        if (empty($this->description)) {
            throw TaskException::invalidDescription();
        }

        $descriptionLen = strlen($this->description);
        if ($descriptionLen > 500) {
            throw TaskException::invalidDescription();
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
