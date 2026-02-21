<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('colleges')->insert([
            ['name' => 'دانشکده مهندسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشکده علوم پایه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'دانشکده مدیریت', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}