<?php

namespace App\Domain\Event\Models;

use App\Domain\User\Models\User;
use App\Models\BaseModel;
use App\Domain\Event\Models\Event;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends BaseModel
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
