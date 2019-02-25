<?php

namespace App\Http\Front\Controllers\Profile;

use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;

class TalksController
{
    public function __invoke(User $user)
    {
        $slots = Slot::query()
            ->with(['event', 'speakers'])
            ->published()
            ->hasSpeaker($user)
            ->orderByDesc('starts_at')
            ->paginate();

        return view('front.profile.talks', compact('user', 'slots'));
    }
}
