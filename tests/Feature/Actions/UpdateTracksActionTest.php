<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\UpdateTracksAction;
use App\Domain\Event\Exceptions\CouldNotDeleteTrack;
use App\Domain\Event\Exceptions\CouldNotUpdateTrack;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use App\Domain\Slot\Models\Slot;
use Tests\TestCase;

class UpdateTracksActionTest extends TestCase
{
    /** @var \App\Domain\Event\Models\Event */
    protected $event;

    public function setUp(): void
    {
        parent::setUp();

        $this->event = factory(Event::class)->create();
    }

    /** @test */
    public function it_can_create_update_and_delete_tracks_in_one_go()
    {
        $track1 = $this->event->tracks()->create(['name' => 'track 1']);
        $track2 =$this->event->tracks()->create(['name' => 'track 2']);
        $track3 = $this->event->tracks()->create(['name' => 'track 3']);

        (new UpdateTracksAction())->execute($this->event, [
            ['id' => $track1->id, 'name' => 'track 1 updated'],
            ['id' => $track2->id, 'name' => 'track 2 updated'],
            ['name' => 'track 4 created'],
        ]);

        $this->assertEquals(
            ['track 1 updated', 'track 2 updated', 'track 4 created'],
            $this->event->refresh()->tracks->pluck('name')->toArray(),
            );
    }

    /** @test */
    public function it_will_not_update_tracks_beloning_to_another_event()
    {
        $trackFromOtherEvent = factory(Track::class)->create();

        $this->expectException(CouldNotUpdateTrack::class);

        (new UpdateTracksAction())->execute($this->event, [
            ['id' => $trackFromOtherEvent->id, 'name' => 'update this'],
        ]);
    }

    /** @test */
    public function it_will_not_delete_a_track_that_still_has_slots()
    {
        $track = factory(Track::class)->create();

        factory(Slot::class)->create([
            'track_id' => $track->id,
            'event_id' => $track->event_id,
        ]);

        $this->expectException(CouldNotDeleteTrack::class);

        (new UpdateTracksAction())->execute($track->event, [
            ['name' => 'new track'],
        ]);
    }
}
