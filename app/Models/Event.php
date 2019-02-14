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

    public $casts = [
        'cfp' => 'boolean',
        'cfp_deadline' => 'datetime',
        'number_of_reviews' => 'integer',
        'average_review_rating' => 'integer',
    ];

    public $dates = [
        'published_at',
        'starts_at',
        'ends_at',
        'approved_at',
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

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
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

    public function scopePublished(Builder $query)
    {
        $query->whereNotNull('published_at');
    }

    public function scopeHasSlotWithSpeaker(Builder $query, User $user)
    {
        $query->whereHas('slots', function (Builder $query) use ($user) {
            $query->ownedBy($user);
        });
    }

    public function scopeHasAttendee(Builder $query, User $user)
    {
        $query->whereHas('attendances', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function isAdministeredBy(User $user): bool
    {
        return $user->owns($this);
    }

    public function eventOfReviewable(): Event
    {
        return $this;
    }
}
