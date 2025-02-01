<?php

namespace App\Domain\Entity\SubTask;

use App\Domain\Exception\SubTaskException;

final class Title
{
    /**
     * @throws SubTaskException
     */
    public function __construct(private string $title)
    {
        $titleLen = strlen($this->title);
        if ($titleLen < 5 || $titleLen > 100) {
            throw SubTaskException::invalidTitle();
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
