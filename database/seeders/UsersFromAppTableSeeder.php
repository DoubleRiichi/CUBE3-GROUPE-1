<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersFromAppTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users_from_app')->insert([
            'username' => 'johndoe',
            'password' => bcrypt('password'),
            'email' => 'johndoe@example.com',
            'right' => 'user',
            'avatar' => 'avatar.jpg',
            'badge' => 'newbie',
            'signup_date' => now(),
        ]);
    }
}