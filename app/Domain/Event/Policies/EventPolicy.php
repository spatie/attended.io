<?php

namespace App\Domain\Event\Policies;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function administer(User $user, Event $event)
    {
        if ($user->organizes($event)) {
            return true;
        };
    }

    public function approve(User $user, Event $event)
    {
        if ($event->isApproved()) {
            return false;
        }
    }

    public function publish(User $user, Event $event)
    {
        if (! $event->isApproved()) {
            return false;
        }

        if ($event->isPublished()) {
            return false;
        }

        if ($user->organizes($event)) {
            return true;
        };
    }

    public function review(User $user, Event $event)
    {
        if ($user->hasReviewed($event)) {
            return false;
        }

        if ($event->starts_at->isFuture()) {
            return false;
        }

        if (now()->subDays(30)->greaterThan($event->ends_at)) {
            return false;
        }
    }
}
