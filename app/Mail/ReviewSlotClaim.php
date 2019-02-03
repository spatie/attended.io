<?php

namespace App\Mail;

use App\Models\PendingOwnership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewSlotClaim extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\Models\Ownership */
    public $pendingOwnership;

    public function __construct(PendingOwnership $pendingOwnership)
    {
        $this->pendingOwnership = $pendingOwnership;
    }

    public function build()
    {
        $claimingUserEmail = $this->pendingOwnership->user->email;

        $slotName = $this->pendingOwnership->ownable->name;

        return $this
            ->subject("{{ $claimingUserEmail }} wants to claim slot named '{{ $slotName }}'")
            ->markdown('mails.review-slot-claim');
    }
}
