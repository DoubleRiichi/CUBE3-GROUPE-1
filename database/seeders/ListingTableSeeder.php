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
            'movie_id' => 1, // Assurez-vous que le film avec l'ID 1 existe
            'user_id' => 1, // Assurez-vous que l'utilisateur avec l'ID 1 existe
        ]);
    }
}