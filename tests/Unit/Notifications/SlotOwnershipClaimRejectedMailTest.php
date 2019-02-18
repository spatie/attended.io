<?php

namespace Tests\Unit\Notifications;

use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use App\Domain\Slot\Notifications\SlotOwnershipClaimRejectedNotification;
use Tests\TestCase;

class SlotOwnershipClaimRejectedMailTest extends TestCase
{
    /** @test */
    public function it_can_render_the_slot_ownership_claim_rejected_notification_to_mail()
    {
        $user = factory(User::class)->create();

        $slot = factory(Slot::class)->create();

        $notification = new SlotOwnershipClaimRejectedNotification($user, $slot);

        $this->assertNotNull($this->getHtmlForNotificationMail($notification, $user));
    }
}
