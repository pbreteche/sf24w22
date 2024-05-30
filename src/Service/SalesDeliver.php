<?php

namespace App\Service;

use App\Entity\Sales;
use App\Message\SalesMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class SalesDeliver
{
    public function __construct(
        private MessageBusInterface $bus,
    ) {
    }

    public function deliver(Sales $sales): void
    {
        $this->bus->dispatch(new SalesMessage($sales));
    }
}
