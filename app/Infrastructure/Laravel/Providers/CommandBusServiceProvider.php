<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Application\Command\AddNewBoardCommand;
use App\Application\Command\AddNewTaskCommand;
use App\Application\CommandHandler\AddNewBoardCommandHandler;
use App\Application\CommandHandler\AddNewTaskCommandHandler;
use App\Application\Query\GetAllUserBoardsQuery;
use App\Application\QueryHandler\GetAllUserBoardsQueryHandler;
use App\Infrastructure\CommandBus\CommandBus;
use App\Infrastructure\CommandBus\SymfonyCommandBus;
use App\Infrastructure\QueryBus\QueryBus;
use App\Infrastructure\QueryBus\SymfonyQueryBus;
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
                            $this->getBoardsCommand($app),
                            $this->getTasksCommand($app),
                        )
                    )
                )
            ]);
        });

        $this->app->singleton(CommandBus::class, function ($app) {
            return new SymfonyCommandBus($app->make(MessageBusInterface::class));
        });

        $this->app->singleton(QueryBus::class, function ($app) {
            return new SymfonyQueryBus($app->make(MessageBusInterface::class));
        });
    }

    public function boot(): void
    {

    }

    private function getBoardsCommand($app): array
    {
        return [
            AddNewBoardCommand::class => [
                new HandlerDescriptor($app->make(AddNewBoardCommandHandler::class)),
            ],
            GetAllUserBoardsQuery::class => [
                new HandlerDescriptor($app->make(GetAllUserBoardsQueryHandler::class)),
            ],
        ];
    }

    private function getTasksCommand($app): array
    {
        return [
            AddNewTaskCommand::class => [
                new HandlerDescriptor($app->make(AddNewTaskCommandHandler::class)),
            ]
        ];
    }
}
