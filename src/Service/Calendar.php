<?php

namespace App\Service;

class Calendar
{
    public function isWeekend(\DateTimeInterface $date): bool
    {
        return 5 < $date->format('N');
    }
}