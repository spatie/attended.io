<?php

namespace Tests\Feature\Actions;

use App\Domain\Slot\Actions\RejectSlotOwnershipClaimAction;
use App\Domain\Slot\Models\SlotOwnershipClaim;
use App\Domain\Slot\Notifications\SlotOwnershipClaimRejectedNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RejectSlotOwnershipClaimActionTest extends TestCase
{
    /** @test */
    public function it_can_reject_an_ownership_claim()
    {
        Notification::fake();

        $claim = factory(SlotOwnershipClaim::class)->create();
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $this->assertFalse($claimingUser->owns($slot));

        (new RejectSlotOwnershipClaimAction())->execute($claim);

        $this->assertFalse($claimingUser->owns($slot->refresh()));
        $this->assertFalse($claim->exists());

        Notification::assertSentTo($claimingUser, SlotOwnershipClaimRejectedNotification::class);
    }
}
