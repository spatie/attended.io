<?php

namespace Tests\Unit\Notifications;

use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use App\Domain\Slot\Notifications\SlotClaimedNotification;
use Tests\TestCase;

class SlotClaimedNotificationTest extends TestCase
{
    /** @test */
    public function it_can_render_the_review_slot_claim_notification_to_mail()
    {
        $user = factory(User::class)->create();

        $slot = factory(Slot::class)->create();

        $notification = (new SlotClaimedNotification($user, $slot));

        $this->assertNotNull($this->getHtmlForNotificationMail($notification, $user));
    }
}
