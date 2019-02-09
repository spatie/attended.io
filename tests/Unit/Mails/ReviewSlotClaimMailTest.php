<?php

namespace Tests\Unit\Mails;

use App\Mail\ReviewSlotClaimMail;
use App\Models\Slot;
use App\Models\User;
use Tests\TestCase;

class ReviewSlotClaimMailTest extends TestCase
{
    /** @test */
    public function it_can_render_the_review_slot_claim_mail()
    {
        $user = factory(User::class)->create();

        $slot = factory(Slot::class)->create();

        $html = (new ReviewSlotClaimMail($user, $slot))->render();

        $this->assertNotNull($html);
    }

}