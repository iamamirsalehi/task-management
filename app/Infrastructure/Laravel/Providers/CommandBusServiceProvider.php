<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Application\Command\AddNewBoardCommand;
use App\Application\Command\AddNewSubTaskCommand;
use App\Application\Command\AddNewTaskCommand;
use App\Application\Command\AssignDeadlineToATaskCommand;
use App\Application\Command\CompleteASubTaskCommand;
use App\Application\Command\CompleteATaskCommand;
use App\Application\Command\PrioritizeATaskCommand;
use App\Application\Command\RemoveSubTaskCommand;
use App\Application\Command\ReopenATaskCommand;
use App\Application\Command\ReopenSubTaskCommand;
use App\Application\Command\StartATaskCommand;
use App\Application\Command\StartSubTaskCommand;
use App\Application\CommandHandler\AddNewBoardCommandHandler;
use App\Application\CommandHandler\AddNewSubTaskCommandHandler;
use App\Application\CommandHandler\AddNewTaskCommandHandler;
use App\Application\CommandHandler\AssignDeadlineToATaskCommandHandler;
use App\Application\CommandHandler\CompleteASubTaskCommandHandler;
use App\Application\CommandHandler\CompleteATaskCommandHandler;
use App\Application\CommandHandler\PrioritizeATaskCommandHandler;
use App\Application\CommandHandler\RemoveSubTaskCommandHandler;
use App\Application\CommandHandler\ReopenATaskCommandHandler;
use App\Application\CommandHandler\ReopenSubTaskCommandHandler;
use App\Application\CommandHandler\StartATaskCommandHandler;
use App\Application\CommandHandler\StartSubTaskCommandHandler;
use App\Application\Query\FilterTasksQuery;
use App\Application\Query\GetAllUserBoardsQuery;
use App\Application\Query\GetBoardTasksQuery;
use App\Application\Query\GetTaskSubTasksQuery;
use App\Application\QueryHandler\FilterTasksQueryHandler;
use App\Application\QueryHandler\GetAllUserBoardsQueryHandler;
use App\Application\QueryHandler\GetBoardTasksQueryHandler;
use App\Application\QueryHandler\GetTaskSubTasksQueryHandler;
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
                            $this->getSubTasksCommand($app),
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
                new HandlerDescriptor($app->make(AssignDeadlineToATaskCommandHandler::class))
            ],
            FilterTasksQuery::class => [
                new HandlerDescriptor($app->make(FilterTasksQueryHandler::class)),
            ],
        ];
    }

    private function getSubTasksCommand($app): array
    {
        return [
            AddNewSubTaskCommand::class => [
                new HandlerDescriptor($app->make(AddNewSubTaskCommandHandler::class)),
            ],
            GetTaskSubTasksQuery::class => [
                new HandlerDescriptor($app->make(GetTaskSubTasksQueryHandler::class)),
            ],
            CompleteASubTaskCommand::class => [
                new HandlerDescriptor($app->make(CompleteASubTaskCommandHandler::class)),
            ],
            StartSubTaskCommand::class => [
                new HandlerDescriptor($app->make(StartSubTaskCommandHandler::class))
            ],
            ReopenSubTaskCommand::class => [
                new HandlerDescriptor($app->make(ReopenSubTaskCommandHandler::class))
            ],
            RemoveSubTaskCommand::class => [
                new HandlerDescriptor($app->make(RemoveSubTaskCommandHandler::class)),
            ],
        ];
    }
}
