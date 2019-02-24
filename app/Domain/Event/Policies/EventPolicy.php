<?php

namespace App\Domain\Event\Policies;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function administer(User $user, Event $event): bool
    {
        return $user->organizes($event);
    }

    public function approve(User $user, Event $event): bool
    {
        return $user->admin;
    }

    public function review(User $user, Event $event): bool
    {
        return true;
    }
}
