<?php

namespace App\Tests\Service;

use App\Service\Calendar;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    public function testIsWeekend()
    {
        $calendar = new Calendar();
        $result = $calendar->isWeekend(new \DateTimeImmutable('2024-05-31'));

        $this->assertFalse($result, '2024-05-31 is friday, not weekend');
    }
}
