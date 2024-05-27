<?php

namespace App\Listener;

use App\Event\PurchaseConfirmedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class PurchaseConfirmedListener
{
    public function __invoke(PurchaseConfirmedEvent $event): void
    {
        dump($event);
        if ($event->getPurchase()->isPriority()) {
            // send alert by SMS
        }
    }
}