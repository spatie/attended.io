<?php

namespace App\Domain\Event\Notifications;

use App\Domain\Event\Models\Event;
use App\Domain\Shared\Notifications\BaseNotification;
use App\Domain\User\Models\User;
use Illuminate\Notifications\Messages\MailMessage;

class EventEndedNotification extends BaseNotification
{
    /** @var \App\Domain\Event\Notifications\Event */
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function toMail(User $notifiable)
    {
        return (new MailMessage)
            ->subject("We hope you had at great time at {$this->event->name}. Please leave some feedback")
            ->markdown('notification-mails.event-ended', [
                'event' => $this->event,
            ]);
    }
}