<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Slot;
use App\Models\SlotOwnershipClaim;
use App\Policies\EventPolicy;
use App\Policies\SlotOwnershipClaimPolicy;
use App\Policies\SlotPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Slot::class => SlotPolicy::class,
        Event::class => EventPolicy::class,
        SlotOwnershipClaim::class => SlotOwnershipClaimPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
