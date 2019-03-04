<?php

namespace App\Domain\Event\Commands;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventEndedNotification;
use App\Domain\User\Models\User;
use Illuminate\Console\Command;

class SendEventEndedNotificationsCommand extends Command
{
    protected $signature = 'attended:send-event-ended-notifications';

    protected $description = 'Send out notifications for events that have ended';

    public function handle()
    {
        Event::query()
            ->whereNull('event_ended_notification_sent_at')
            ->where('ends_at', '<=', now())
            ->get()
            ->each(function (Event $event) {
                $event
                    ->attendees()
                    ->whereNull('event_ended_notification_sent_at')
                    ->get()
                    ->each(function (User $attendee) use ($event) {
                        /** TODO: make sure that this notification gets queued */
                        $attendee->notify(new EventEndedNotification($event));

                        $this->markAsEventNotificationEndedSentToUser($attendee);
                    });

                $this->markAsEventNotificationSentToAllUsersOfEvent($event);
            });
    }

    protected function markAsEventNotificationSentToAllUsersOfEvent(Event $event)
    {
        $event->event_ended_notification_sent_at = now();

        $event->save();
    }

    protected function markAsEventNotificationEndedSentToUser(User $user)
    {
        $user->event_ended_notification_sent_at = now();

        $user->save();
    }
}
