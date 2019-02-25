<?php

namespace App\Providers;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Policies\EventPolicy;
use App\Domain\Review\Models\Review;
use App\Domain\Review\Policies\ReviewPolicy;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\SlotOwnershipClaim;
use App\Domain\Slot\Policies\SlotOwnershipClaimPolicy;
use App\Domain\Slot\Policies\SlotPolicy;
use App\Domain\User\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
        Review::class => ReviewPolicy::class,
        Slot::class => SlotPolicy::class,
        SlotOwnershipClaim::class => SlotOwnershipClaimPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::after(function (User $user) {
            return $user->admin;
        });
    }
}
