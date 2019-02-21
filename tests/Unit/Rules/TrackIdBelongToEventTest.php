<?php

namespace Tests\Unit\Rules;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use App\Domain\Event\Rules\TrackIdBelongsToEvent;
use Tests\TestCase;

class TrackIdBelongToEventTest extends TestCase
{
    /** @var \App\Domain\Event\Models\Event */
    protected $event;

    public function setUp()
    {
        parent::setUp();

        $this->event = factory(Event::class)->create();
    }

    /** @test */
    public function it_can_determine_if_a_track_id_belongs_to_an_event()
    {
        $trackId = factory(Track::class)->create([
           'event_id' => $this->event->id,
        ])->id;
        $this->assertTrue($this->rulePasses($trackId));


        $trackIdFromOtherEvent = factory(Track::class)->create()->id;
        $this->assertFalse($this->rulePasses($trackIdFromOtherEvent));

        $this->assertTrue($this->rulePasses(''));
    }

    public function rulePasses($trackId): bool
    {
        return (new TrackIdBelongsToEvent($this->event))->passes('trackId', $trackId);
    }
}
