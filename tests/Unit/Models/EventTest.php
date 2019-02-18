<?php

namespace Tests\Unit\Models;

use App\Domain\Event\Models\Attendance;
use App\Domain\Event\Models\Event;
use App\Models\Slot;
use App\Domain\User\Models\User;
use Tests\TestCase;

class EventTest extends TestCase
{
    /** @test */
    public function it_has_a_scope_to_get_published_events()
    {
        $publishedEvent = factory(Event::class)->create();

        factory(Event::class)->state('unpublished')->create();

        $publishedEvents = Event::published()->get();

        $this->assertCount(1, $publishedEvents);
        $this->assertEquals($publishedEvent->id, $publishedEvents->first()->id);
    }

    /** @test */
    public function it_has_a_scope_to_get_events_where_a_given_user_is_speaking()
    {
        $slots = factory(Slot::class, 3)->create();

        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $slots[0]->owners()->attach($user);
        $slots[1]->owners()->attach($user);
        $slots[2]->owners()->attach($anotherUser);

        $eventsWhereUserSpeaksAt = Event::hasSlotWithSpeaker($user)->get();
        $this->assertCount(2, $eventsWhereUserSpeaksAt);
        $this->assertEquals([
            $slots[0]->event->id,
            $slots[1]->event->id,
        ], $eventsWhereUserSpeaksAt->pluck('id')->toArray());

        $eventsWhereAnotherUserSpeaksAt = Event::hasSlotWithSpeaker($anotherUser)->get();
        $this->assertCount(1, $eventsWhereAnotherUserSpeaksAt);
        $this->assertEquals([
            $slots[2]->event->id,
        ], $eventsWhereAnotherUserSpeaksAt->pluck('id')->toArray());
    }

    /** @test */
    public function it_has_a_scope_to_get_events_that_the_user_is_attending()
    {
        $events = factory(Event::class, 3)->create();

        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        Attendance::create(['event_id' => $events[0]->id, 'user_id' => $user->id]);
        Attendance::create(['event_id' => $events[1]->id, 'user_id' => $anotherUser->id]);
        Attendance::create(['event_id' => $events[2]->id, 'user_id' => $user->id]);
        Attendance::create(['event_id' => $events[2]->id, 'user_id' => $anotherUser->id]);

        $eventsWhereUserSpeaksAt = Event::hasAttendee($user)->get();
        $this->assertCount(2, $eventsWhereUserSpeaksAt);
        $this->assertEquals([
            $events[0]->id,
            $events[2]->id,
        ], $eventsWhereUserSpeaksAt->pluck('id')->toArray());

        $eventsWhereUserSpeaksAt = Event::hasAttendee($anotherUser)->get();
        $this->assertCount(2, $eventsWhereUserSpeaksAt);
        $this->assertEquals([
            $events[1]->id,
            $events[2]->id,
        ], $eventsWhereUserSpeaksAt->pluck('id')->toArray());
    }
}
