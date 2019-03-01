<?php

namespace Tests\Unit\Policies;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\User\Models\User;
use Tests\TestCase;

class SlotPolicyTest extends TestCase
{
    /** @var \App\Domain\Event\Models\Event */
    protected $event;

    /** @var \App\Domain\User\Models\User */
    protected $user;

    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    public function setUp(): void
    {
        parent::setUp();

        $this->setNow(2019, 1, 1, 13, 0, 0);

        $this->event = factory(Event::class)->create([
            'starts_at' => now()->subDays(2),
            'ends_at' => now(),
        ]);

        $this->slot = factory(Slot::class)->create([
            'starts_at' => now()->subDays(2),
            'ends_at' => now(),
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
        factory(Speaker::class)->create([
           'slot_id' => $this->slot->id,
           'user_id' => $this->user->id,
        ]);

        $this->assertFalse($this->user->can('claim', $this->slot));
    }

    /** @test */
    public function a_user_who_is_already_claiming_the_slot_cannot_claim_it_again()
    {
        $this->slot->claimingUsers()->attach($this->user);

        $this->assertFalse($this->user->can('claim', $this->slot));
    }

    /** @test */
    public function the_organiser_of_the_event_can_administer_the_slots()
    {
        $this->assertFalse($this->user->can('administer', $this->slot));

        $this->event->organizingUsers()->attach($this->user);

        $this->assertTrue($this->user->can('administer', $this->slot->refresh()));
    }
}
