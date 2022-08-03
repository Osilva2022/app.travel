<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\Instagram::class
    ];

    protected function scheduleTimezone()
    {
        return 'America/Mexico_City';
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('instagram:task')->everyMinute();   
    }
      
}
