<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            Event::class => 'Event',
            Slot::class => 'Slot'
        ]);
    }
}
