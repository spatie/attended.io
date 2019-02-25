<?php

namespace Tests\Unit\Notifications;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventApprovedNotification;
use App\Domain\User\Models\User;
use Tests\TestCase;

class EventApprovedNotificationTest extends TestCase
{
    /** @test */
    public function it_can_render_the_event_approved_notification_to_mail()
    {
        $organizingUser = factory(User::class)->create();
        $event = factory(Event::class)->create();
        $event->organizingUsers()->attach($organizingUser);

        $notification = (new EventApprovedNotification($event));

        $this->assertNotNull($this->getHtmlForNotificationMail($notification, $organizingUser));
    }
}
