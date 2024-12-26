<?php

namespace App\Infrastructure\QueryBus;

use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class SymfonyQueryBus implements QueryBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function handle(object $query)
    {
        $envelope = $this->messageBus->dispatch($query);

        $handledStamp = $envelope->last(HandledStamp::class);

        if (!$handledStamp) {
            throw new \RuntimeException('query was not handled properly');
        }

        return $handledStamp->getResult();
    }
}
