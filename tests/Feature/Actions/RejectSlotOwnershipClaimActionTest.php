<?php

namespace Tests\Feature\Actions;

use App\Actions\ApproveSlotOwnershipClaimAction;
use App\Actions\RejectSlotOwnershipClaimAction;
use App\Mail\SlotOwnershipClaimApprovedMail;
use App\Mail\SlotOwnershipClaimRejectedMail;
use App\Models\SlotOwnershipClaim;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RejectSlotOwnershipClaimActionTest extends TestCase
{
    /** @test */
    public function it_can_reject_an_ownership_claim()
    {
        Mail::fake();
        $claim = factory(SlotOwnershipClaim::class)->create();
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $this->assertFalse($claimingUser->owns($slot));

        (new RejectSlotOwnershipClaimAction())->execute($claim);

        $this->assertFalse($claimingUser->owns($slot->refresh()));
        $this->assertFalse($claim->exists());

        Mail::assertQueued(
            SlotOwnershipClaimRejectedMail::class,
            function (SlotOwnershipClaimRejectedMail $mail) use ($claimingUser) {
                return $mail->hasTo($claimingUser->email);
            }
        );
    }
}
