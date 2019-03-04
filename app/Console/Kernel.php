<?php

namespace App\Console;

use App\Domain\Event\Commands\SendEventEndedNotificationsCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendEventEndedNotificationsCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('attend:send-event-ended-notifications')->everyThirtyMinutes();
    }
}
