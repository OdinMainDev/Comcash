<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        if(!env("RATE_PARSER_BESTCHANGE", true)){
            $schedule->command('app:rates-parser')->everyMinute();
        }else{
            $schedule->command('app:parser-bestchange')->everyMinute();
        }
        if(env("CLEAR_EXCHANGES_COMMAND_ENABLE", false)){
            $schedule->command('app:clear-exchanges')->everyMinute();
        }
        $schedule->command('app:bugged-withdraws')->everyMinute();

        $schedule->command('app:garantex-payment')->everyMinute();
        $schedule->command('app:garantex-withdraw')->everyMinute();

        $schedule->command('app:aifory-payment')->everyMinute();
        $schedule->command('app:aifory-withdraw')->everyMinute();


        // РУЧНЫЕ ЗАЯВКИ
        $schedule->command('app:check-manual-exchanges')->everyMinute();

        // Кеширование данных
        $schedule->command('app:cache-directions')->everyFiveMinutes();
        // $schedule->command('app:cache-export')->everyThirtySeconds();
        $schedule->command('app:cache-tarrifs-page')->everyMinute();
        

        // $schedule->command('app:bybit-payment')->everyMinute();
        // $schedule->command('app:okx-withdraw')->everyMinute();


        $schedule->command('firewall:unblockip')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
