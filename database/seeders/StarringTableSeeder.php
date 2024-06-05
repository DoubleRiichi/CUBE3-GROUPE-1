<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarringTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('starring')->insert([
            'movie_id' => 1, // Assurez-vous que le film avec l'ID 1 existe
            'personalities_id' => 1, // Assurez-vous que la personnalité avec l'ID 1 existe
        ]);
    }
}