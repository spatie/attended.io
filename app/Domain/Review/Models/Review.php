<?php

namespace App\Domain\Review\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends BaseModel
{
    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewableType(): string
    {
        return lcfirst(class_basename($this->reviewable_type));
    }
}
