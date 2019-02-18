<?php

namespace App\Domain\Event\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organizer extends BaseModel
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
