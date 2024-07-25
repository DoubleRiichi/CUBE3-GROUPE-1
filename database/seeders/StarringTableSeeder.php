<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarringTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('starring')->insert([
            'movie_id' => 1,
            'personalities_id' => 1, 
        ]);
    }
}