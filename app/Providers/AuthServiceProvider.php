<?php

namespace App\Providers;

use App\Models\Slot;
use App\Policies\SlotPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Slot::class => SlotPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
