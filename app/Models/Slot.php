<?php

namespace App\Models;

use App\Models\Concerns\Commentable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slot extends BaseModel
{
    use Commentable;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
