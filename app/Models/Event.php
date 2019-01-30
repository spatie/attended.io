<?php

namespace App\Models;

use App\Models\Concerns\Commentable;
use App\Models\Presenters\PresentsEvent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends BaseModel
{
    use Commentable,
        HasSlug,
        PresentsEvent;

    public $dates = [
        'starts_at',
        'ends_at',
    ];

    public function slots(): HasMany
    {
        $this->hasMany(Slot::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['id', 'name'])
            ->saveSlugsTo('slug');
    }

    public function idSlug(): string
    {
        return "{$this->id}-{$this->slug}";
    }
}
