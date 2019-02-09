<?php

namespace App\Mail;

use App\Models\PendingOwnership;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SlotOwnershipClaimRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\Mail\User */
    public $claimingUser;

    /** @var \App\Models\Slot */
    public $slot;

    public function __construct(User $claimingUser, Slot $slot)
    {
        $this->claimingUser = $claimingUser;

        $this->slot = $slot;
    }

    public function build()
    {
        return $this
            ->subject("Your claim on {{ $this->slot->name }} has been rejected")
            ->markdown('mails.slot-ownership-claim-rejected');
    }
}
