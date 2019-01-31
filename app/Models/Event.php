<?php

namespace App\Models;

use App\Models\Concerns\HasReviews;
use App\Models\Concerns\HasSlug;
use App\Models\Interfaces\Reviewable;
use App\Models\Presenters\PresentsEvent;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends BaseModel implements Reviewable
{
    use HasReviews,
        HasSlug,
        PresentsEvent;

    public $dates = [
        'starts_at',
        'ends_at',
    ];

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class)
            ->orderBy('starts_at')
            ->orderBy('location');
    }
}
