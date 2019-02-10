<?php

namespace Tests\Unit\Models\Concerns;

use App\Models\Event;
use App\Models\User;
use Tests\TestCase;

class HasOwnersTest extends TestCase
{
    /** @test */
    public function it_has_a_scope_to_get_events_that_are_owned_by_a_given_user()
    {
        $events = factory(Event::class, 3)->create();

        $user = factory(User::class)->create();
        $anotherUser = factory(User::class)->create();

        $events[0]->owners()->attach($user);
        $events[1]->owners()->attach($user);
        $events[2]->owners()->attach($anotherUser);

        $eventsOwnedByUser = Event::ownedBy($user)->get();
        $this->assertCount(2, $eventsOwnedByUser);
        $this->assertEquals([
            $events[0]->id,
            $events[1]->id,
        ], $eventsOwnedByUser->pluck('id')->toArray());

        $eventsOwnedByUser = Event::ownedBy($anotherUser)->get();
        $this->assertCount(1, $eventsOwnedByUser);
        $this->assertEquals([
            $events[2]->id,
        ], $eventsOwnedByUser->pluck('id')->toArray());
    }
}
