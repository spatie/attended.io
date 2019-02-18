<?php

namespace Tests\Unit\Notifications;

use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use App\Domain\Slot\Notifications\SlotOwnershipClaimApprovedNotification;
use Tests\TestCase;

class SlotOwnershipClaimApprovedMailTest extends TestCase
{
    /** @test */
    public function it_can_render_the_slot_ownership_claim_approved_notification_to_mail()
    {
        $user = factory(User::class)->create();

        $slot = factory(Slot::class)->create();

        $notification = new SlotOwnershipClaimApprovedNotification($user, $slot);

        $this->assertNotNull($this->getHtmlForNotificationMail($notification, $user));
    }
}
