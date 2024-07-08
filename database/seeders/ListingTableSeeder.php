<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListingTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('listing')->insert([
            'status' => 'Watched',
            'note' => 5,
            'movie_id' => 1, 
            'user_id' => 1, 
        ]);
    }
}