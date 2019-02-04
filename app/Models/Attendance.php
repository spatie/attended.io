<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeForEvents(Builder $query, array $events)
    {
        $query->whereIn('event_id', array_pluck($events, 'id'));
    }

    public function scopeByUser(Builder $query, ?User $user)
    {
        $query->where('user_id', optional($user)->id);
    }
}
