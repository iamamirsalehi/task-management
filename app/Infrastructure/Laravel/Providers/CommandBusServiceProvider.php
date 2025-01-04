<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Application\Command\AddNewBoardCommand;
use App\Application\Command\AddNewTaskCommand;
use App\Application\Command\AssignDeadlineToATaskCommand;
use App\Application\Command\CompleteATaskCommand;
use App\Application\Command\PrioritizeATaskCommand;
use App\Application\Command\ReopenATaskCommand;
use App\Application\Command\StartATaskCommand;
use App\Application\CommandHandler\AddNewBoardCommandHandler;
use App\Application\CommandHandler\AddNewTaskCommandHandler;
use App\Application\CommandHandler\AssignDeadlineToATaskCommandHandler;
use App\Application\CommandHandler\CompleteATaskCommandHandler;
use App\Application\CommandHandler\PrioritizeATaskCommandHandler;
use App\Application\CommandHandler\ReopenATaskCommandHandler;
use App\Application\CommandHandler\StartATaskCommandHandler;
use App\Application\Query\GetAllUserBoardsQuery;
use App\Application\Query\GetBoardTasksQuery;
use App\Application\QueryHandler\GetAllUserBoardsQueryHandler;
use App\Application\QueryHandler\GetBoardTasksQueryHandler;
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
            GetBoardTasksQuery::class => [
                new HandlerDescriptor($app->make(GetBoardTasksQueryHandler::class)),
            ],
        ];
    }

    private function getTasksCommand($app): array
    {
        return [
            AddNewTaskCommand::class => [
                new HandlerDescriptor($app->make(AddNewTaskCommandHandler::class)),
            ],
            StartATaskCommand::class => [
                new HandlerDescriptor($app->make(StartATaskCommandHandler::class)),
            ],
            CompleteATaskCommand::class => [
                new HandlerDescriptor($app->make(CompleteATaskCommandHandler::class))
            ],
            ReopenATaskCommand::class => [
                new HandlerDescriptor($app->make(ReopenATaskCommandHandler::class))
            ],
            PrioritizeATaskCommand::class => [
                new HandlerDescriptor($app->make(PrioritizeATaskCommandHandler::class))
            ],
            AssignDeadlineToATaskCommand::class => [
                new AssignDeadlineToATaskCommandHandler($app->make(AssignDeadlineToATaskCommandHandler::class))
            ]
        ];
    }
}
