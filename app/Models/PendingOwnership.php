<?php

namespace App\Models;

use App\Models\Interfaces\Ownable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PendingOwnership extends BaseModel
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ownable(): MorphTo
    {
        return $this->morphTo();
    }

    public function approve()
    {
        Ownership::createFromPendingOwnership($this);

        $this->delete();

        return $this;
    }

    public function reject()
    {
        $this->delete();
    }
}
