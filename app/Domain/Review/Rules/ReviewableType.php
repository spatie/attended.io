<?php

namespace App\Domain\Review\Rules;

use App\Domain\Event\Models\Event;
use App\Models\Slot;
use Illuminate\Contracts\Validation\Rule;

class ReviewableType implements Rule
{
    public function passes($attribute, $value)
    {
        return in_array($value, [
            Event::class,
            Slot::class,
        ]);
    }

    public function message()
    {
        return 'You can not review this.';
    }
}
