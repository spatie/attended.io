<?php

namespace App\Domain\Review\Models;

use App\Domain\Event\Models\Event;
use App\Domain\Shared\Models\BaseModel;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use App\Http\Front\Controllers\Events\ShowEventFeedbackController;
use App\Http\Front\Controllers\Slots\ShowSlotController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends BaseModel
{
    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewableType(): string
    {
        return lcfirst(class_basename($this->reviewable_type));
    }

    public function getPermalink(): string
    {
        if ($this->reviewable_type === Slot::class) {
            $url = action(ShowSlotController::class, $this->reviewable_id);
        }

        if ($this->reviewable_type === Event::class) {
            $url = action(ShowEventFeedbackController::class, $this->reviewable_id);
        }

        return "$url#review{$this->id}";
    }
}
