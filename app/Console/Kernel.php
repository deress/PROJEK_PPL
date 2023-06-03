<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $reservations = DB::table('reservations')
                ->where('tanggal_reservasi', '>', date("Y-m-d"))
                ->orWhere('tanggal_reservasi', '=', date("Y-m-d") and 'jam_akhir', '>', date("H:i"))
                ->get();

            foreach ($reservations as $reservation) {
                if ($reservation->status == 'belum bayar' and $reservation->tenggat_pembayaran < Carbon::now()) {
                    $validatedData['status'] = 'reservasi dibatalkan';
                    DB::table('reservations')
                        ->where('id', $reservation->id)
                        ->update($validatedData);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
