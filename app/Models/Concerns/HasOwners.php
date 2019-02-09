<?php

namespace App\Models\Concerns;

use App\Models\SlotOwnershipClaim;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasOwners
{
    public function owners(): MorphToMany
    {
        return $this->morphToMany(User::class, 'ownable', 'ownerships');
    }

    public function pendingOwners(): MorphToMany
    {
        return $this->morphToMany(User::class, 'ownable', 'pending_ownerships');
    }
}
