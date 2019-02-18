<?php

namespace App\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Ownership extends BaseModel
{
    public static function createFromPendingOwnership(PendingOwnership $pendingOwnership): self
    {
        return static::create([
            'user_id' => $pendingOwnership->id,
            'ownable_type' => $pendingOwnership->ownable_type,
            'ownable_id' => $pendingOwnership->ownable_id,
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ownable(): MorphTo
    {
        return $this->morphTo();
    }
}
