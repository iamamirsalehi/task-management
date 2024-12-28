<?php

namespace App\Domain\Exception;

class TaskException extends BusinessException
{
    private const INVALID_ID = 'invalid task id';
    private const INVALID_TITLE = 'invalid task title';
    private const INVALID_DESCRIPTION = 'invalid task description';
    private const INVALID_DEADLINE = 'invalid task deadline';

    public static function invalidID(): self
    {
        return new self(self::INVALID_ID);
    }

    public static function invalidTitle(): self
    {
        return new self(self::INVALID_TITLE);
    }

    public static function invalidDescription(): self
    {
        return new self(self::INVALID_DESCRIPTION);
    }

    public static function invalidDeadline(): self
    {
        return new self(self::INVALID_DEADLINE);
    }
}
