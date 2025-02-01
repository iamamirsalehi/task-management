<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Domain\Persistence\Repository\BoardRepository;
use App\Domain\Persistence\Repository\SubTaskRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use App\Domain\Persistence\Repository\Transaction;
use App\Domain\Persistence\Repository\UserRepository;
use App\Infrastructure\Persistence\Repository\Doctrine\DoctrineBoardRepository;
use App\Infrastructure\Persistence\Repository\Doctrine\DoctrineSubTaskRepository;
use App\Infrastructure\Persistence\Repository\Doctrine\DoctrineTaskRepository;
use App\Infrastructure\Persistence\Repository\Doctrine\DoctrineTransaction;
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
            return new DoctrineBoardRepository($app->make(EntityManagerInterface::class));
        });

        $this->app->bind(TaskRepository::class, function ($app) {
            return new DoctrineTaskRepository($app->make(EntityManagerInterface::class));
        });

        $this->app->bind(SubTaskRepository::class, function ($app) {
            return new DoctrineSubTaskRepository($app->make(EntityManagerInterface::class));
        });

        $this->app->bind(Transaction::class, function ($app) {
            return new DoctrineTransaction($app->make(EntityManagerInterface::class));
        });
    }

    public function boot(): void
    {

    }
}
