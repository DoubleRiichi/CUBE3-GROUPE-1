<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->insert([
            'titre' => 'Example Movie',
            'synopsis' => 'An example movie synopsis.',
            'genre' => 'Drama',
            'image' => 'example_movie.jpg',
            'release_date' => '2024-01-01',
        ]);
    }
}
