<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Domain\Persistence\Repository\UserRepository;
use App\Infrastructure\Persistence\Repository\Doctrine\DoctrineUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new DoctrineUserRepository($app->make(EntityManagerInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
