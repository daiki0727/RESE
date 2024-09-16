<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [];
        $start = Carbon::createFromFormat('H:i', '10:00');
        $end = Carbon::createFromFormat('H:i', '23:30');

        while($start <= $end) {
            $times[] = ['time_slot' => $start->format('H:i')];
            $start->addMinutes(30);
        }

        DB::table('reservation_times')->insert($times);
    }
}
