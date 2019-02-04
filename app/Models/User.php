<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Interfaces\Ownable;
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
        $this->hasMany(Review::class);
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

    public function claimingOwnership(Ownable $ownable): bool
    {
        return $ownable->pendingOwners->contains(function (User $owner) {
            return $owner->id === $this->id;
        });
    }

    public function attendedEvents(): HasManyThrough
    {
        return $this->hasManyThrough(Event::class, Attendance::class);
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
}
