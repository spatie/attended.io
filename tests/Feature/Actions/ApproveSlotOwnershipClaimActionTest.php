<?php

namespace Tests\Feature\Actions;

use App\Domain\Slot\Actions\ApproveSlotOwnershipClaimAction;
use App\Models\SlotOwnershipClaim;
use App\Notifications\SlotOwnershipClaimApprovedNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ApproveSlotOwnershipClaimActionTest extends TestCase
{
    /** @test */
    public function it_can_approve_an_ownership_claim()
    {
        Notification::fake();

        $claim = factory(SlotOwnershipClaim::class)->create();
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $this->assertFalse($claimingUser->owns($slot));

        (new ApproveSlotOwnershipClaimAction())->execute($claim);

        $this->assertTrue($claimingUser->owns($slot->refresh()));
        $this->assertFalse($claim->exists());

        Notification::assertSentTo($claimingUser, SlotOwnershipClaimApprovedNotification::class);
    }
}
