<?php

namespace App\Domain\Entity\Task;

use App\Domain\Exception\TaskException;

final readonly class Title
{
    /**
     * @throws TaskException
     */
    public function __construct(private string $title)
    {
        if (empty($this->title)) {
            throw TaskException::invalidTitle();
        }

        $titleLen = strlen($this->title);
        if ($titleLen < 5 || $titleLen > 100) {
            throw TaskException::invalidTitle();
        }
    }

    public function toPrimitiveType(): string
    {
        return $this->title;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
