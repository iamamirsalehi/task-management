<?php

namespace App\Domain\Persistence\Repository;

interface Transaction
{
    public function warp(callable $callable): void;
}
