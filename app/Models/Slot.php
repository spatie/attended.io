<?php

namespace App\Models;

use App\Models\Concerns\HasReviews;
use App\Models\Concerns\HasSlug;
use App\Models\Interfaces\Reviewable;
use App\Models\Presenters\PresentsSlot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slot extends BaseModel implements Reviewable
{
    use HasReviews,
        HasSlug,
        PresentsSlot;

    public $dates = [
        'starts_at',
        'ends_at',
    ];

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trackName(): string
    {
        return optional($this->track)->name ?? '';
    }
}
