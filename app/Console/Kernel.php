<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // no scheduled tasks needed for this project
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
