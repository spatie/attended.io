<?php

namespace App\Domain\Event\Models;

use App\Domain\Event\Models\Presenters\PresentsEvent;
use App\Domain\Review\Interfaces\Reviewable;
use App\Domain\Review\Models\Concerns\HasReviews;
use App\Domain\Shared\Models\BaseModel;
use App\Domain\Shared\Models\Concerns\HasSlug;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Http\Request;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Event extends BaseModel implements Reviewable, Searchable
{
    use HasReviews,
        HasSlug,
        PresentsEvent;

    public $casts = [
        'cfp' => 'boolean',
        'cfp_deadline' => 'datetime',
        'number_of_reviews' => 'integer',
        'average_review_rating' => 'integer',
        'published_at' => 'datetime',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class)->orderBy('order_column');
    }

    public function organizingUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'organizers')->withTimestamps();
    }

    public function organizers(): HasMany
    {
        return $this->hasMany(Organizer::class);
    }

    public function scopeOrganizedBy(Builder $query, User $user)
    {
        $query->whereHas('organizers', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        });
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
        return $this->hasMany(Attendance::class)->where('user_id', optional(auth()->user())->id);
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
            $query->hasSpeaker($user);
        });
    }

    public function scopeHasAttendee(Builder $query, User $user)
    {
        $query->whereHas('attendances', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

    public function scopeUpcomingOrPast(Builder $query, Request $request)
    {
        if ($request->has('past')) {
            $query
                ->where('ends_at', '<=', now())
                ->orderByDesc('starts_at');

            return;
        }

        $query
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at');
    }

    public function isAdministeredBy(User $user): bool
    {
        return $user->organizes($this);
    }

    public function eventOfReviewable(): Event
    {
        return $this;
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            route('events.show-schedule', $this->idSlug()),
            );
    }
}
