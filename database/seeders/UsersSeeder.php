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
            'right' => 'admin',
            'avatar' => 'avatars/default_avatars/Avatar_1.jpg',
            'badge' => 'newbie',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}