<?php

namespace Tests\Unit\Notifications;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventApprovedNotification;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Notifications\SpeakerInvitationNotification;
use App\Domain\User\Models\User;
use Tests\TestCase;

class SpeakerInvitationNotificationTest extends TestCase
{
    /** @test */
    public function it_can_render_the_speaker_invitation_notification_to_mail()
    {
        $slot = factory(Slot::class)->create();
        $speaker = factory(Speaker::class)->create();

        $notification = new SpeakerInvitationNotification($slot);

        $this->assertNotNull(
            $this->getHtmlForNotificationMail($notification, $speaker)
        );
    }
}
