<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasOwners
{
    public function owners(): MorphToMany
    {
        return $this->morphToMany(User::class, 'ownable', 'ownerships');
    }
}