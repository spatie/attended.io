<?php

namespace Tests\Unit\Models\Concerns;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use Tests\TestCase;

class HasOwnersTest extends TestCase
{
    /** @test */
    public function it_has_a_scope_to_get_events_that_are_organized_by_a_given_user()
    {
        $events = factory(Event::class, 3)->create();

        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $events[0]->organizingUsers()->attach($user);
        $events[1]->organizingUsers()->attach($user);
        $events[2]->organizingUsers()->attach($anotherUser);

        $eventsOrganizedByUser = Event::organizedBy($user)->get();
        $this->assertCount(2, $eventsOrganizedByUser);
        $this->assertEquals([
            $events[0]->id,
            $events[1]->id,
        ], $eventsOrganizedByUser->pluck('id')->toArray());

        $eventsOrganizedByUser = Event::organizedBy($anotherUser)->get();
        $this->assertCount(1, $eventsOrganizedByUser);
        $this->assertEquals([
            $events[2]->id,
        ], $eventsOrganizedByUser->pluck('id')->toArray());
    }
}
