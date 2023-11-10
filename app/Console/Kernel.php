<?php

namespace App\Console;

use App\Http\Controllers\PointDeVenteController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();



        $schedule->call(function () {
            Log::info("Scheduled task is running 11:00 : ");
            app(PointDeVenteController::class)->sendFailedJobs();
        })->dailyAt("22:00");



        $schedule->call(function () {
            Log::info("Scheduled task is running 11:00 : ");
            app(PointDeVenteController::class)->sendFailedJobs();
        })->dailyAt("11:00");


        $schedule->call(function () {
            Log::info("Scheduled task is running 03:00 ");
            app(PointDeVenteController::class)->sendFailedJobs();
        })->dailyAt("03:00");
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
