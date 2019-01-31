<?php

namespace App\Models\Concerns;

use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reviewable
{
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
