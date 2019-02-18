<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Interfaces\Ownable;
use App\Models\Interfaces\Reviewable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasSlug;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'admin' => 'bool',
        'can_create_events_immediately' => 'bool',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function events(): MorphToMany
    {
        return $this
            ->morphedByMany(Event::class, 'ownable', 'ownerships')
            ->orderBy('starts_at', 'desc');
    }

    public function slots(): MorphToMany
    {
        return $this->morphedByMany(Slot::class, 'ownable', 'ownerships');
    }

    public function owns(Ownable $ownable): bool
    {
        return $ownable->owners->contains(function (User $owner) {
            return $owner->id === $this->id;
        });
    }

    public function isClaimingSlot(Slot $slot): bool
    {
        return SlotOwnershipClaim::query()
            ->where('user_id', $this->id)
            ->where('slot_id', $slot->id)
            ->exists();
    }

    public function attendedEvents(): HasManyThrough
    {
        return $this->hasManyThrough(Event::class, Attendance::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function attended(Event $event): bool
    {
        return Attendance::query()
            ->where([
                'user_id' => $this->id,
                'event_id' => $event->id,
            ])
            ->count() > 0;
    }

    public function organisesEvents(): bool
    {
        return $this->events()->count() > 0;
    }

    public function speaksAtEvents(): bool
    {
        return $this->slots()->count() > 0;
    }

    public function attendsEvents(): bool
    {
        return $this->attendances()->count() > 0;
    }

    public function markEmailAsUnverified()
    {
        $this->email_verified_at = null;

        $this->save();

        return $this;
    }

    public function hasReviewed(Reviewable $reviewable)
    {
        return $reviewable->reviews()->where('user_id', $this->id)->exists();
    }
}
