<?php

namespace App\Event;

use App\Entity\Purchase;
use Symfony\Contracts\EventDispatcher\Event;

class PurchaseConfirmedEvent extends Event
{
    public function __construct(
        private readonly Purchase $purchase,
    ) {

    }

    public function getPurchase(): Purchase
    {
        return $this->purchase;
    }
}