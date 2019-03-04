<?php

namespace Tests\Feature\Commands;

use App\Domain\Event\Models\Attendee;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventEndedNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendEventEndedNotificationsCommandTest extends TestCase
{
    /** @var \App\Domain\Event\Models\Event */
    protected $event;

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        $this->setNow(2019, 1, 1, 13, 0, 0);

        $this->event = factory(Event::class)->create([
            'ends_at' => now(),
        ]);

        factory(Attendee::class, 3)->create([
            'event_id' => $this->event->id,
        ]);
    }

    /** @test */
    public function it_can_send_notifications_to_all_attendees_when_an_event_has_ended()
    {
        $this->artisan('attended:send-event-ended-notifications')->assertExitCode(0);

        Notification::assertTimesSent($this->event->attendees->count(), EventEndedNotification::class);

        foreach ($this->event->attendees as $attendee) {
            Notification::assertSentTo($attendee->user, EventEndedNotification::class);
        }
    }

    /** @test */
    public function it_will_not_send_the_event_ended_notification_if_the_event_hasnt_ended_yet()
    {
        $this->event->update(['ends_at' => now()->subMinute()]);

        $this->artisan('attended:send-event-ended-notifications')->assertExitCode(0);

        Notification::assertNothingSent();
    }

    /** @test */
    public function it_will_only_send_one_notification_per_attendee_even_if_the_command_is_executed_twice()
    {
        $this->artisan('attended:send-event-ended-notifications')->assertExitCode(0);

        $this->artisan('attended:send-event-ended-notifications')->assertExitCode(0);

        Notification::assertTimesSent($this->event->attendees->count(), EventEndedNotification::class);
    }
}
