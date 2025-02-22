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
    private const CAN_NOT_HAVE_SUB_TASK = 'can not have subtask';
    private const ALL_SUB_TASKS_MUST_BE_COMPLETED = 'all subtasks must be completed';
    private const TASK_ALREADY_IS_IN_PROGRESS = 'task already is in progress';
    private const TASK_IS_ALREADY_NOT_STARTED = 'task is already not started';
    private const NOW_IS_REQUIRED = 'now is required';

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

    public static function canNotHaveSubTask(): self
    {
        return new self(self::CAN_NOT_HAVE_SUB_TASK);
    }

    public static function allSubTasksMustBeCompleted(): self
    {
        return new self(self::ALL_SUB_TASKS_MUST_BE_COMPLETED);
    }

    public static function taskAlreadyIsInProgress(): self
    {
        return new self(self::TASK_ALREADY_IS_IN_PROGRESS);
    }

    public static function taskIsAlreadyNotStarted(): self
    {
        return new self(self::TASK_IS_ALREADY_NOT_STARTED);
    }

    public static function nowIsRequired(): self
    {
        return new self(self::NOW_IS_REQUIRED);
    }
}
