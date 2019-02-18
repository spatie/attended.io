<?php

namespace App\Domain\Slot\Models;

use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use App\Models\BaseModel;
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
