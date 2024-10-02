<?php

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule)
    {
        // Schedule the command to run every hour
        $schedule->command('fetch:posts')->hourly();
        //$schedule->command('fetch:posts')->everyMinute();
    }
}
