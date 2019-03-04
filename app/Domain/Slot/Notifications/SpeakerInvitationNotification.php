<?php

namespace App\Domain\Slot\Notifications;

use App\Domain\Shared\Notifications\BaseNotification;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use Illuminate\Notifications\Messages\MailMessage;

class SpeakerInvitationNotification extends BaseNotification
{
    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    public function __construct(Slot $slot)
    {
        $this->slot = $slot;
    }

    public function toMail(Speaker $speaker)
    {
        return (new MailMessage)
            ->subject("You'll be presenting '{$this->slot->name}' at '{$this->slot->event->name}'")
            ->markdown('notification-mails.speaker-invitation', [
                'slot' => $this->slot,
                'speaker' => $speaker
            ]);
    }
}
