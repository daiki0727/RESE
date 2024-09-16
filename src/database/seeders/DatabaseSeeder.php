<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(ReservationTimesTableSeeder::class);
        $this->call(ReservationNumbersTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(UserShopRoleTableSeeder::class);
        $this->call(CourseSeeder::class);
        
    }
}
