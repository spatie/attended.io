<?php

namespace Tests\Unit\Models;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Slot;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @var \App\Models\User */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_can_determine_if_a_user_speaks_at_events()
    {
        $this->assertFalse($this->user->speaksAtEvents());

        $slot = factory(Slot::class)->create();

        $slot->owners()->attach($this->user);

        $this->assertTrue($this->user->speaksAtEvents());
    }

    /** @test */
    public function it_can_determine_if_a_user_organises_events()
    {
        $this->assertFalse($this->user->organisesEvents());

        $event = factory(Event::class)->create();

        $event->owners()->attach($this->user);

        $this->assertTrue($this->user->organisesEvents());
    }

    /** @test */
    public function it_can_determine_if_a_user_attends_events()
    {
        $this->assertFalse($this->user->attendsEvents());

        $event = factory(Event::class)->create();

        Attendance::create([
            'event_id' => $event->id,
            'user_id' => $this->user->id,
        ]);

        $this->assertTrue($this->user->attendsEvents());
    }
}
