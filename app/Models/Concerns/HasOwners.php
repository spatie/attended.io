<?php

namespace App\Models\Concerns;

use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasOwners
{
    public function owners(): MorphToMany
    {
        return $this->morphToMany(User::class, 'ownable', 'ownerships');
    }

    public function scopeOwnedBy(Builder $query, User $user)
    {
        $query->whereHas('owners', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
}
