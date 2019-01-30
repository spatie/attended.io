<?php

namespace Tests\Unit\Models\Presenters;

use App\Models\Event;
use Carbon\Carbon;
use Tests\TestCase;

class PresentsEventTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider timespanProvider
     */
    public function it_can_present_the_timespan_of_an_event(
        string $startsAt,
        string $endsAt,
        string $expectedTimespan
    ) {
        $event = factory(Event::class)->create([
            'starts_at' => Carbon::createFromFormat('Y-m-d', $startsAt),
            'ends_at' => Carbon::createFromFormat('Y-m-d', $endsAt),
        ]);

        $this->assertEquals($expectedTimespan, $event->timespan());
    }

    public function timespanProvider()
    {
        return [
            ['2019-01-01', '2019-01-01', '1 January 2019'],
            ['2019-01-01', '2019-01-02', '1 - 2 January 2019'],
            ['2019-01-31', '2019-02-01', '31 January - 1 February 2019'],
            ['2019-12-31', '2020-01-01', '31 December 2019 - 1 January 2020'],

        ];
    }
}
