<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Reservation;
use App\Mail\ReservationReminder;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            
            //予約日の当日を取得
            $today = now()->startOfDay();

            //予約日が今日の予約を取得
            $reservations = Reservation::whereDate('reservation_date', $today)->get();

            foreach($reservations as $reservation) {
                Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));
            }
        })->dailyAt('8:00'); //毎日午前8時に実行
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
