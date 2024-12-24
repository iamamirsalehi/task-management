<?php

namespace App\Domain\Exception;

class UserException extends BusinessException
{
    private const INVALID_USER_iD = 'invalid user id';

    public static function invalidUserID(): self
    {
        return new self(self::INVALID_USER_iD);
    }
}
