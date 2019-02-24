<?php

namespace Tests\Unit\Notifications;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventCreatedNotification;
use App\Domain\User\Models\User;
use Tests\TestCase;

class EventCreatedNotificationTest extends TestCase
{
    /** @test */
    public function it_can_render_the_event_created_notification_to_mail()
    {
        $admin = factory(User::class)->state('admin')->create();

        $event = factory(Event::class)->create();
        $event->organizingUsers()->attach(factory(User::class)->create());

        $notification = (new EventCreatedNotification($event));

        $this->assertNotNull($this->getHtmlForNotificationMail($notification, $admin));
    }
}
