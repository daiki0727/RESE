<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserShopRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRoleId = DB::table('roles')->where('role_name', '管理者')->value('id');

        $adminUser = DB::table('users')->where('email', 'admin@mail.com')->first();

        if(!$adminUser) {
            $adminUserId = DB::table('users')->insertGetId([
                'name' => 'Admin User',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin1234'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $adminUserId = $adminUser->id;
        }

        DB::table('user_shop_role')->updateOrInsert(
            [
                'user_id' => $adminUserId,
                'role_id' => $adminRoleId,
                'shop_id' => 1
            ],
            ['created_at' => now(), 'updated_at' => now()]
        );
    }
}
