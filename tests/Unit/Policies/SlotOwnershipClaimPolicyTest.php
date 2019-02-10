<?php

namespace Tests\Unit\Policies;

use App\Models\SlotOwnershipClaim;
use App\Models\User;
use App\Policies\SlotOwnershipClaimPolicy;
use Tests\TestCase;

class SlotOwnershipClaimPolicyTest extends TestCase
{
    /** @var \App\Models\Event */
    protected $slotOwnershipClaim;

    /** @var \App\Models\User */
    protected $user;

    /** @var \App\Policies\EventPolicy */
    protected $policy;

    public function setUp()
    {
        parent::setUp();

        $this->slotOwnershipClaim = factory(SlotOwnershipClaim::class)->create();

        $this->user = factory(User::class)->create();

        $this->policy = new SlotOwnershipClaimPolicy();
    }

    /** @test */
    public function an_owner_of_event_is_allowed_administer_claims_to_its_slots()
    {
        $this->assertFalse($this->policyAllows('administer'));

        $this->slotOwnershipClaim->slot->event->owners()->attach($this->user);

        $this->assertTrue($this->policyAllows('administer'));
    }

    protected function policyAllows(string $ability)
    {
        return $this->policy->$ability($this->user->refresh(), $this->slotOwnershipClaim->refresh());
    }
}
