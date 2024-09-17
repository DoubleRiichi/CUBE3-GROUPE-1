<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@admin.fr',
            'permissions' => 'admin',
            'avatar' => 'avatars/default_avatars/Avatar_1.png',
            'name' => 'admin',
            'badge' => 'newbie',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'user',
            'password' => bcrypt('user'),
            'email' => 'user@user.fr',
            'permissions' => 'user',
            'avatar' => 'avatars/default_avatars/Avatar_1.png',
            'name' => 'user',
            'badge' => 'newbie',
            'created_at' => now(),
            'updated_at' => now()
        ]);


    }
}