<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('personalities')->insert([
            'name' => 'John Doe',
            'popularity' => 'High',
        ]);
    }
}