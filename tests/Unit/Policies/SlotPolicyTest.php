<?php

namespace Tests\Unit\Policies;

use App\Models\Event;
use App\Models\Slot;
use App\Models\User;
use Tests\TestCase;

class SlotPolicyTest extends TestCase
{

    /** @var \App\Models\Event */
    protected $event;

    /** @var \App\Models\User */
    protected $user;

    /** @var \App\Models\Slot */
    protected $slot;

    public function setUp()
    {
        parent::setUp();

        $this->setNow(2019, 1, 1, 13, 0, 0);

        $this->event = factory(Event::class)->create([
            'ends_at' => now(),
        ]);

        $this->slot = factory(Slot::class)->create([
            'event_id' => $this->event->id,
        ]);

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function an_event_can_be_reviewed_up_until_one_month_after_it_ends()
    {
        $this->assertTrue($this->user->can('addReview', $this->slot));

        $this->progressTime(60 * 24 * 29);
        $this->assertTrue($this->user->can('addReview', $this->slot));

        $this->progressTime(60 * 24 * 30);
        $this->assertFalse($this->user->can('addReview', $this->slot));

        $ownerOfEvent = factory(User::class)->create();
        $this->event->owners()->attach($ownerOfEvent);
        $this->slot->refresh();

        $this->assertTrue($ownerOfEvent->can('addReview', $this->slot));
    }
}
