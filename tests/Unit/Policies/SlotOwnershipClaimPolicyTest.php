<?php

namespace Tests\Unit\Policies;

use App\Models\SlotOwnershipClaim;
use App\Domain\User\Models\User;
use Tests\TestCase;

class SlotOwnershipClaimPolicyTest extends TestCase
{
    /** @var \App\Models\Event */
    protected $slotOwnershipClaim;

    /** @var \App\Domain\User\Models\User */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->slotOwnershipClaim = factory(SlotOwnershipClaim::class)->create();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function an_owner_of_event_is_allowed_administer_claims_to_its_slots()
    {
        $this->assertFalse($this->user->can('administer', $this->slotOwnershipClaim));

        $this->slotOwnershipClaim->slot->event->owners()->attach($this->user);
        $this->slotOwnershipClaim->refresh();

        $this->assertTrue($this->user->can('administer', $this->slotOwnershipClaim));
    }
}
