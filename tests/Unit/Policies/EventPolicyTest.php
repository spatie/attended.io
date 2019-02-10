<?php

namespace Tests\Unit\Policies;

use App\Models\Event;
use App\Models\User;
use Tests\TestCase;

class EventPolicyTest extends TestCase
{
    /** @var \App\Models\Event */
    protected $event;

    /** @var \App\Models\User */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->setNow(2019, 1, 1, 13, 0, 0);

        $this->event = factory(Event::class)->create([
            'ends_at' => now(),
        ]);

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function an_owner_of_event_is_allowed_to_administer_it()
    {
        $this->assertFalse($this->user->can('administer', $this->event));

        $this->event->owners()->attach($this->user);
        $this->event->refresh();

        $this->assertTrue($this->user->can('administer', $this->event));
    }

    /** @test */
    public function an_owner_a_another_event_cannot_administer_this_event()
    {
        $anotherEvent = factory(Event::class)->create();

        $anotherEvent->owners()->attach($this->user);
        $this->event->refresh();

        $this->assertFalse($this->user->can('administer', $this->event));
    }

    /** @test */
    public function an_event_can_be_reviewed_up_until_one_month_after_it_ends()
    {
        $this->assertTrue($this->user->can('addReview', $this->event));

        $this->progressTime(60 * 24 * 29);
        $this->assertTrue($this->user->can('addReview', $this->event));

        $this->progressTime(60 * 24 * 30);
        $this->assertFalse($this->user->can('addReview', $this->event));

        $ownerOfEvent = factory(User::class)->create();
        $this->event->owners()->attach($ownerOfEvent);
        $this->event->refresh();

        $this->assertTrue($ownerOfEvent->can('addReview', $this->event));
    }
}
