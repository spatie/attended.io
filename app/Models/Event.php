<?php

namespace App\Models;

use App\Models\Concerns\HasOwners;
use App\Models\Concerns\HasReviews;
use App\Models\Concerns\HasSlug;
use App\Models\Interfaces\Ownable;
use App\Models\Interfaces\Reviewable;
use App\Models\Presenters\PresentsEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends BaseModel implements Reviewable, Ownable
{
    use HasReviews,
        HasSlug,
        PresentsEvent,
        HasOwners;

    public $dates = [
        'starts_at',
        'ends_at',
    ];

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class)->orderBy('order_column');
    }

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class)
            ->with('track')
            ->orderBy('starts_at');
    }

    public function attendees(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Attendance::class);
    }

    public function currentUserAttendance(): HasMany
    {
        return $this->hasMany(Attendance::class)->where('user_id', optional(current_user())->id);
    }

    public function attendedByCurrentUser(): bool
    {
        return count($this->currentUserAttendance) > 0;
    }

    public function attendedBy(?User $user): bool
    {
        if (is_null($user)) {
            return false;
        }

        return Attendance::query()
            ->where('event_id', $this->id)
            ->where('user_id', $user->id)
            ->count() > 0;
    }

    public function scopeApproved(Builder $query)
    {
        $query->whereNotNull('approved_at');
    }

    public function scopeHasSlotWithSpeaker(Builder $query, User $user)
    {
        $query->whereHas('slots', function (Builder $query) use ($user) {
            $query->ownedBy($user);
        });
    }
}
