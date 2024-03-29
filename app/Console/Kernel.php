<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\Instagram::class,
        Commands\Divisas::class,
        Commands\Weathers::class,
        Commands\GenerateSitemap::class,
    ];

    protected function scheduleTimezone()
    {
        return 'America/Mexico_City';
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('instagram:task')->monthly();
        $schedule->command('weathers:task')->daily();
        $schedule->command('divisa:task')->everyMinute();
        $schedule->command('sitemap:generate')->everyFourHours();


    }

}
