<?php

namespace App\Models;

use App\Models\Concerns\Commentable;
use App\Models\Concerns\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slot extends BaseModel
{
    use Commentable,
        Sluggable;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
