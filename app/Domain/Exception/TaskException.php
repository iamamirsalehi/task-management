<?php

namespace App\Domain\Exception;

class TaskException extends BusinessException
{
    private const INVALID_ID = 'invalid task id';
    private const INVALID_TITLE = 'invalid task title';
    private const INVALID_DESCRIPTION = 'invalid task description';
    private const INVALID_DEADLINE = 'invalid task deadline';
    private const TASK_MUST_BE_NOT_STARTED = 'task must be not started';
    private const TASK_MUST_BE_IN_PROGRESS = 'task must be in progress';
    private const TASK_MUST_BE_COMPLETED = 'task must be completed';
    private const TASK_MUST_BE_IN_PROGRESS_OR_NOT_STARTED_TO_CHANGE_THE_PRIORITY = 'task must be completed or not completed to change the priority';

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

    public static function taskMustBeNoStarted(): self
    {
        return new self(self::TASK_MUST_BE_NOT_STARTED);
    }

    public static function taskMustBeInProgress(): self
    {
        return new self(self::TASK_MUST_BE_IN_PROGRESS);
    }

    public static function taskMustBeCompleted(): self
    {
        return new self(self::TASK_MUST_BE_COMPLETED);
    }

    public static function taskMustBeInProgressOrNotStartedToChangeThePriority(): self
    {
        return new self(self::TASK_MUST_BE_IN_PROGRESS_OR_NOT_STARTED_TO_CHANGE_THE_PRIORITY);
    }
}
