<?php

namespace App\Domain\Entity\Task;

use App\Domain\Exception\TaskException;

final readonly class Deadline
{
    /**
     * @throws \Exception
     */
    public function __construct(private string $deadline)
    {
        $deadlineAsDatetime = new \DateTime($this->deadline);
        if ($deadlineAsDatetime->diff(new \DateTime('now'))->m < 1) {
            throw TaskException::invalidDeadline();
        }
    }

    public function toPrimitiveType(): string
    {
        return $this->deadline;
    }

    public function __toString(): string
    {
        return $this->deadline;
    }
}
