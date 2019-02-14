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

    /** @test */
    public function a_slot_cannot_be_reviewed_before_it_starts()
    {
        $slot = factory(Slot::class)->create([
            'starts_at' => now()->addMinute(),
        ]);

        $this->assertFalse($this->user->can('addReview', $slot));

        $this->progressTime(1);

        $this->assertTrue($this->user->can('addReview', $slot));
    }

    /** @test */
    public function a_user_without_a_verified_email_cannot_post_reviews()
    {
        $unverifiedUser = factory(User::class)->state('unverified-email')->create();

        $this->assertTrue($unverifiedUser->can('addReview', $this->slot));
    }

    /** @test */
    public function a_user_can_claim_a_slot()
    {
        $this->assertTrue($this->user->can('claim', $this->slot));
    }

    /** @test */
    public function a_unverified_user_cannot_claim_a_slot()
    {
        $unverifiedUser = factory(User::class)->state('unverified-email')->create();

        $this->assertFalse($unverifiedUser->can('claim', $this->slot));
    }

    /** @test */
    public function an_owner_of_a_slot_cannot_claim_it_again()
    {
        $this->slot->owners()->attach($this->user);

        $this->assertFalse($this->user->can('claim', $this->slot));
    }

    /** @test */
    public function a_user_who_is_already_claiming_the_slot_cannot_claim_it_again()
    {
        $this->slot->claimingUsers()->attach($this->user);

        $this->assertFalse($this->user->can('claim', $this->slot));
    }
}
