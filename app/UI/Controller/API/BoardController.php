<?php

namespace App\UI\Controller\API;

use App\Domain\Entity\User\User;
use App\Domain\Persistence\Repository\UserRepository;

final readonly class BoardController
{
    public function __construct(private UserRepository $userRepository)
    {

    }

    public function add()
    {
        $user = new User();
        $this->userRepository->save($user);
    }
}
