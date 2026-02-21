<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationGroupSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('education_groups')->insert([
            ['name' => 'مهندسی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'علوم پایه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'مدیریت', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}