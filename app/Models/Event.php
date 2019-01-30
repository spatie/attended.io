<?php

namespace App\Models;

use App\Models\Concerns\Commentable;
use App\Models\Concerns\Sluggable;
use App\Models\Presenters\PresentsEvent;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends BaseModel
{
    use Commentable,
        Sluggable,
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
