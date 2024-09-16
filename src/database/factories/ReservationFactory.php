<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ReservationTime;
use App\Models\ReservationNumber;


class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'shop_id' => \App\Models\Shop::inRandomOrder()->first()->id,
            'reservation_date' => $this->faker->date(),
            'reservation_time_id' => ReservationTime::inRandomOrder()->first()->id,
            'reservation_number_id' => ReservationNumber::inRandomOrder()->first()->id,
        ];
    }
}