<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListingTableSeeder extends Seeder
{
    public function run()
    {   
        DB::table('listing_movies')->insert([
            'status' => 'Vus',
            'movie_id' => 11, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);
        DB::table('listing_movies')->insert([
            'status' => 'Vus',
            'movie_id' => 35, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);

        DB::table('listing_movies')->insert([
            'status' => 'Vus',
            'movie_id' => 71, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);

        DB::table('listing_movies')->insert([
            'status' => 'À voir',
            'movie_id' => 38, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);
        DB::table('listing_movies')->insert([
            'status' => 'À voir',
            'movie_id' => 73, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);
        DB::table('listing_movies')->insert([
            'status' => 'À voir',
            'movie_id' => 77, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);

        DB::table('listing_movies')->insert([
            'status' => 'À voir',
            'movie_id' => 78, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);

        DB::table('listing_movies')->insert([
            'status' => 'À voir',
            'movie_id' => 111, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);


    }
}