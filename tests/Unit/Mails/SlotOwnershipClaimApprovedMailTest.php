<?php

namespace Tests\Unit\Mails;

use App\Mail\SlotOwnershipClaimApprovedMail;
use App\Models\Slot;
use App\Models\User;
use Tests\TestCase;

class SlotOwnershipClaimApprovedMailTest extends TestCase
{
    /** @test */
    public function it_can_render_the_review_slot_claim_mail()
    {
        $user = factory(User::class)->create();

        $slot = factory(Slot::class)->create();

        $html = (new SlotOwnershipClaimApprovedMail($user, $slot))->render();

        $this->assertNotNull($html);
    }
}
