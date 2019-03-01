<?php

namespace App\Domain\Slot\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Speaker extends BaseModel
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(Slot::class);
    }

    public function name(): string
    {
        return $this->user
            ? $this->user->name
            : $this->name;
    }

    public function email(): string
    {
        return $this->user
            ? $this->user->email
            : $this->email;
    }
}
