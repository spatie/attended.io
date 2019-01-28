<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends BaseModel
{
    public $dates = [
        'starts_at',
        'ends_at',
    ];

    public function slots(): HasMany
    {
        $this->hasMany(Slot::class);
    }
}
