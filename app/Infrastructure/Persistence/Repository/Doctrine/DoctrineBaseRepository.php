<?php

namespace App\Infrastructure\Persistence\Repository\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

class DoctrineBaseRepository
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {

    }
}
