<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Domain\Persistence\Repository\BoardRepository;
use App\Domain\Persistence\Repository\UserRepository;
use App\Infrastructure\Persistence\Repository\Doctrine\DoctrineBoardRepository;
use App\Infrastructure\Persistence\Repository\Doctrine\DoctrineUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;
use Doctrine\ORM\EntityManager;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new DoctrineUserRepository($app->make(EntityManagerInterface::class));
        });

        $this->app->bind(BoardRepository::class, function ($app) {
            return new DoctrineBoardRepository($app->make(EntityManager::class));
        });
    }

    public function boot(): void
    {

    }
}
