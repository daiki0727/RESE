<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
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
            'rate' => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->realText(200),
        ];
    }
}
