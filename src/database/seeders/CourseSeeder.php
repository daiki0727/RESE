<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'course_name' => 'プラチナ',
            'price' => 5000,
        ]);

        Course::create([
            'course_name' => 'ゴールド',
            'price' => 3000,
        ]);

        Course::create([
            'course_name' => 'シルバー',
            'price' => 2000,
        ]);
    }
}
