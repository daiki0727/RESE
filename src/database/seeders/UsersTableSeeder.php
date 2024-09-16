<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str; 

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->create();

        // 特定のユーザーを手動で作成
        User::create([
            'name' => '山田太郎',
            'email' => 'yamada@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('yamada123'), // パスワードをハッシュ化
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }   
}
