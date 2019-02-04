<?php

namespace App\Models;

use App\Services\UserAttendance;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Attendance extends BaseModel
{
    public static function getForUser(?User $user, Collection $events): UserAttendance
    {
        return new UserAttendance($user, $events);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
