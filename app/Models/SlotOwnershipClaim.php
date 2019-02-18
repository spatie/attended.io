<?php

namespace App\Models;

use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SlotOwnershipClaim extends BaseModel
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(Slot::class);
    }
}
