<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('attend:send-event-ended-notifications')->everyThirtyMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/../Domain/Event/Commands');
    }
}
