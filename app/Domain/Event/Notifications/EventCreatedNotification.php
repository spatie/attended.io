<?php

namespace App\Domain\Event\Notifications;

use App\Domain\Event\Models\Event;
use App\Domain\Shared\Notifications\BaseNotification;
use App\Domain\User\Models\User;
use Illuminate\Notifications\Messages\MailMessage;

class EventCreatedNotification extends BaseNotification
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
            ->subject("Event `{$this->event->name}` has been created.")
            ->markdown('notification-mails.event-created', [
                'event' => $this->event,
            ]);
    }
}
