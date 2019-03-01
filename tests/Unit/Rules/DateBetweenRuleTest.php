<?php

namespace Tests\Unit\Rules;

use App\Domain\Slot\Rules\DateBetweenRule;
use Carbon\Carbon;
use Tests\TestCase;

class DateBetweenRuleTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider dates
     */
    public function it_can_determine_if_a_date_is_between_two_other_dates(
        string $date,
        string $startDate,
        string $endDate,
        bool $expectedResult
    ) {
        $startDate = $this->createDate($startDate);
        $endDate = $this->createDate($endDate);

        $rule = new DateBetweenRule($startDate, $endDate);

        $actualResult = $rule->passes('date', $date);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function dates(): array
    {
        return [
            ['2019-01-01 13:00', '2019-01-01 12:55', '2019-01-01 13:05', true],
            ['2019-01-01 13:00', '2019-01-01 13:00', '2019-01-01 13:00', true],
            ['2019-01-01 12:54', '2019-01-01 12:55', '2019-01-01 13:05', false],
            ['2019-01-01 12:55', '2019-01-01 12:55', '2019-01-01 13:05', true],
            ['2019-01-01 12:56', '2019-01-01 12:55', '2019-01-01 13:05', true],
            ['2019-01-01 13:04', '2019-01-01 12:55', '2019-01-01 13:05', true],
            ['2019-01-01 13:05', '2019-01-01 12:55', '2019-01-01 13:05', true],
            ['2019-01-01 13:06', '2019-01-01 12:55', '2019-01-01 13:05', false],
        ];
    }

    protected function createDate(string $time): Carbon
    {
        return Carbon::createFromFormat('Y-m-d H:i', $time);
    }
}
