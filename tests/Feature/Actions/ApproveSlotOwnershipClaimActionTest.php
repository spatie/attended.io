<?php

namespace Tests\Feature\Actions;

use App\Actions\ApproveSlotOwnershipClaimAction;
use App\Mail\SlotOwnershipClaimApprovedMail;
use App\Models\SlotOwnershipClaim;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ApproveSlotOwnershipClaimActionTest extends TestCase
{
    /** @test */
    public function it_can_approve_an_ownership_claim()
    {
        Mail::fake();
        $claim = factory(SlotOwnershipClaim::class)->create();
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $this->assertFalse($claimingUser->owns($slot));

        (new ApproveSlotOwnershipClaimAction())->execute($claim);

        $this->assertTrue($claimingUser->owns($slot->refresh()));
        $this->assertFalse($claim->exists());

        Mail::assertQueued(
            SlotOwnershipClaimApprovedMail::class,
            function (SlotOwnershipClaimApprovedMail $mail) use ($claimingUser) {
                return $mail->hasTo($claimingUser->email);
            }
        );
    }
}
