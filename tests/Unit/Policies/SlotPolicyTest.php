<?php

namespace Tests\Unit\Policies;

use App\Models\Event;
use App\Models\Slot;
use App\Domain\User\Models\User;
use Tests\TestCase;

class SlotPolicyTest extends TestCase
{
    /** @var \App\Models\Event */
    protected $event;

    /** @var \App\Domain\User\Models\User */
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
    public function a_user_without_a_verified_email_cannot_post_reviews()
    {
        $unverifiedUser = factory(User::class)->state('unverified-email')->create();

        $this->assertTrue($unverifiedUser->can('review', $this->slot));
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
