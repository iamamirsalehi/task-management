<?php

namespace App\Infrastructure\CommandBus;

use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyCommandBus implements CommandBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function handle(object $command): void
    {
        $this->messageBus->dispatch($command);
    }
}
