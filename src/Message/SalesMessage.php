<?php

namespace App\Message;

use App\Entity\Sales;

class SalesMessage
{
    public function __construct(private Sales $sales)
    {
    }

    public function getSales(): Sales
    {
        return $this->sales;
    }
}
