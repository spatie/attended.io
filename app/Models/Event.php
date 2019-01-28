<?php

namespace App\Models;

use App\Models\Concerns\Commentable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends BaseModel
{
    use Commentable;

    public $dates = [
        'starts_at',
        'ends_at',
    ];

    public function slots(): HasMany
    {
        $this->hasMany(Slot::class);
    }
}
