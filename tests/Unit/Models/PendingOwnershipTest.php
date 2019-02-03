<?php

namespace Tests\Unit\Models;

use App\Models\PendingOwnership;
use App\Models\Slot;
use App\Models\User;
use Tests\TestCase;

class PendingOwnershipTest extends TestCase
{
    /** @var \App\Models\User */
    protected $user;

    /** @var \App\Models\Slot */
    protected $slot;

    /** @var \App\Models\PendingOwnership */
    protected $pendingOwnership;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->slot = factory(Slot::class)->create();

        $this->pendingOwnership = PendingOwnership::create([
            'user_id' => $this->user->id,
            'ownable_type' => get_class($this->slot),
            'ownable_id' => $this->slot->id,
        ]);
    }

    /** @test */
    public function a_pending_ownership_can_be_approved()
    {
        $this->assertTrue($this->user->claimingOwnership($this->slot));
        $this->assertFalse($this->user->owns($this->slot));

        $this->pendingOwnership->approve();

        $this->slot->refresh();
        $this->assertFalse($this->user->refresh()->claimingOwnership($this->slot));
        $this->assertTrue($this->user->owns($this->slot));
    }

    /** @test */
    public function a_pending_ownership_can_be_rejected()
    {
        $this->assertTrue($this->user->claimingOwnership($this->slot));
        $this->assertFalse($this->user->owns($this->slot));

        $this->pendingOwnership->reject();

        $this->slot->refresh();
        $this->assertFalse($this->user->refresh()->claimingOwnership($this->slot));
        $this->assertFalse($this->user->owns($this->slot));
    }
}
