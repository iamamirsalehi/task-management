<?php

namespace App\Domain\Exception;

class BoardException extends BusinessException
{
    private const INVALID_BOARD_ID = 'invalid board id';
    private const INVALID_BOARD_NAME = 'invalid board name';
    private const INVALID_BOARD_DESCRIPTION = 'invalid board description';
    private const BOARD_ALREADY_EXISTS = 'board already exists';

    public static function invalidID(): self
    {
        return new self(self::INVALID_BOARD_ID);
    }

    public static function invalidName(): self
    {
        return new self(self::INVALID_BOARD_NAME);
    }

    public static function invalidDescription(): self
    {
        return new self(self::INVALID_BOARD_DESCRIPTION);
    }

    public static function boardAlreadyExists(): self
    {
        return new self(self::BOARD_ALREADY_EXISTS);
    }
}
