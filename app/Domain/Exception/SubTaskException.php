<?php

namespace App\Domain\Exception;

class SubTaskException extends BusinessException
{
    private const INVALID_ID = 'invalid sub task id';
    private const INVALID_TITLE = 'invalid sub task title';
    private const INVALID_DESCRIPTION = 'invalid sub task description';
    private const CAN_NOT_HAVE_HIERARCHY = 'can not have hierarchy';
    private const SUB_TASK_IS_ALREADY_STARTED = 'sub task is already started';
    private const CAN_NOT_START_SUB_TASK = 'can not start sub task';
    private const PARENT_MUST_NO_BE_COMPLETED = 'parent must no be completed';
    private const CAN_NOT_COMPLETE_SUB_TASK = 'can not complete sub task';
    private const CAN_NOT_REOPEN_SUB_TASK = 'can not reopen sub task';

    public static function canNotHaveHierarchy(): self
    {
        return new self(self::CAN_NOT_HAVE_HIERARCHY);
    }

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

    public static function subTaskIsAlreadyStarted(): self
    {
        return new self(self::SUB_TASK_IS_ALREADY_STARTED);
    }

    public static function canNotStartSubTask(): self
    {
        return new self(self::CAN_NOT_START_SUB_TASK);
    }

    public static function parentMustNotBeCompleted(): self
    {
        return new self(self::PARENT_MUST_NO_BE_COMPLETED);
    }

    public static function canNotCompleteSubTask(): self
    {
        return new self(self::CAN_NOT_COMPLETE_SUB_TASK);
    }

    public static function canNotReopenSubTask(): self
    {
        return new self(self::CAN_NOT_REOPEN_SUB_TASK);
    }
}
