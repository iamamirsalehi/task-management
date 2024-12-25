<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Application\Command\AddNewBoardCommand;
use App\Application\CommandHandler\AddNewBoardCommandHandler;
use App\Infrastructure\CommandBus\CommandBus;
use App\Infrastructure\CommandBus\SymfonyCommandBus;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Messenger\Handler\HandlerDescriptor;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class CommandBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MessageBusInterface::class, function ($app) {
            return new MessageBus([
                new HandleMessageMiddleware(
                    new HandlersLocator(
                        array_merge(
                            $this->getBoardsCommand($app)
                        )
                    )
                )
            ]);
        });

        $this->app->singleton(CommandBus::class, function ($app) {
            return new SymfonyCommandBus($app->make(MessageBusInterface::class));
        });
    }

    public function boot(): void
    {

    }

    private function getBoardsCommand($app): array
    {
        return [
            AddNewBoardCommand::class => [
                new HandlerDescriptor($app->make(AddNewBoardCommandHandler::class))
            ]
        ];
    }
}
