<?php

namespace App\Models;

use App\Models\Concerns\HasOwners;
use App\Models\Concerns\HasReviews;
use App\Models\Concerns\HasSlug;
use App\Models\Interfaces\Ownable;
use App\Models\Interfaces\Reviewable;
use App\Models\Presenters\PresentsEvent;
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
}
