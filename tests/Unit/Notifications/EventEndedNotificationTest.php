<?php

namespace Tests\Unit\Notifications;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventEndedNotification;
use App\Domain\User\Models\User;
use Tests\TestCase;

class EventEndedNotificationTest extends TestCase
{
    /** @test */
    public function it_can_render_the_event_ended_notification_to_mail()
    {
        $user = factory(User::class)->create();

        $event = factory(Event::class)->create();

        $notification = (new EventEndedNotification($event));

        $this->assertNotNull($this->getHtmlForNotificationMail($notification, $user));
    }
}
