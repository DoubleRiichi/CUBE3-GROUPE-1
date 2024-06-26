<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListingTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('listing_movies')->insert([
            'status' => 'À voir',
            'movie_id' => 5, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 2, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);
        DB::table('listing_movies')->insert([
            'status' => 'À voir',
            'movie_id' => 6, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 2, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);
    }
}