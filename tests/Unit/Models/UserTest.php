<?php

namespace Tests\Unit\Models;

use App\Domain\Event\Models\Attendance;
use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @var \App\Domain\User\Models\User */
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

        $slot->speakingUsers()->attach($this->user);

        $this->assertTrue($this->user->speaksAtEvents());
    }

    /** @test */
    public function it_can_determine_if_a_user_organises_events()
    {
        $this->assertFalse($this->user->organisesEvents());

        $event = factory(Event::class)->create();

        $event->organizingUsers()->attach($this->user);

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

    /** @test */
    public function it_can_determine_if_a_user_has_reviewed_a_reviewable()
    {
        $event = factory(Event::class)->create();

        $user = factory(User::class)->create();

        $this->assertFalse($user->hasReviewed($event));

        $event->reviews()->create([
            'user_id' => $user->id,
            'rating' => $reviewAttributes['rating'] ?? null,
            'remarks' => $reviewAttributes['remarks'] ?? null,
        ]);

        $this->assertTrue($user->hasReviewed($event));
    }
}
