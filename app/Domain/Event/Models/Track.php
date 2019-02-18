<?php

namespace App\Domain\Event\Models;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Track extends Model implements Sortable
{
    use SortableTrait;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class);
    }
}
