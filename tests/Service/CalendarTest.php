<?php

namespace App\Tests\Service;

use App\Service\Calendar;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    #[DataProvider('isWeekendProvider')]
    public function testIsWeekend($input1, $expected)
    {
        $calendar = new Calendar();
        $result = $calendar->isWeekend(new \DateTimeImmutable($input1));

        $this->assertEquals($expected, $result, '2024-05-31 is friday, not weekend');
    }

    public static function isWeekendProvider(): array
    {
        return [
            ['2024-05-31', false],
            ['2024-05-25', true],
        ];
    }
}
