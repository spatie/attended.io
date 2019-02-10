<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Review;
use App\Models\Slot;
use App\Models\SlotOwnershipClaim;
use App\Policies\EventPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\SlotOwnershipClaimPolicy;
use App\Policies\SlotPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    }
}
