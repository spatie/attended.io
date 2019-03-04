<?php

namespace App\Domain\Slot\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Speaker extends BaseModel
{
    use Notifiable;

    public $dates = [
        'speaker_invitation_sent_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(Slot::class);
    }

    public function name(): string
    {
        return $this->user
            ? $this->user->name
            : $this->name;
    }

    public function email(): string
    {
        return $this->user
            ? $this->user->email
            : $this->email;
    }

    public function hasBeenSentInvitation(): bool
    {
        return ! is_null($this->speaker_invitation_sent_at);
    }

    public function markAsInvitationSent()
    {
        $this->speaker_invitation_sent_at = now();

        $this->save();

        return $this;
    }

    public function hasUserAccount(): bool
    {
        return ! is_null($this->user);
    }
}
