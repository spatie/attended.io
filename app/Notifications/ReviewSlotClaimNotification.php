<?php

namespace App\Notifications;

use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use Illuminate\Notifications\Messages\MailMessage;

class ReviewSlotClaimNotification extends BaseNotification
{
    /** @var \App\Mail\User */
    protected $claimingUser;

    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    public function __construct(User $claimingUser, Slot $slot)
    {
        $this->claimingUser = $claimingUser;

        $this->slot = $slot;
    }

    public function toMail(User $notifiable)
    {
        return (new MailMessage)
            ->subject("{$this->claimingUser->email} wants to claim the '{$this->slot->name}' slot")
            ->markdown('notification-mails.review-slot-claim', [
                'claimingUser' => $this->claimingUser,
                'slot' => $this->slot,
            ]);
    }
}
