<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slot extends BaseModel
{
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
