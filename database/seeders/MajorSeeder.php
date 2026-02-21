<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        // فرض: education_groups به ترتیب: 1=مهندسی، 2=علوم پایه، 3=مدیریت
        DB::table('majors')->insert([
            ['education_group_id' => 1, 'name' => 'مهندسی نرم‌افزار', 'created_at' => now(), 'updated_at' => now()],
            ['education_group_id' => 1, 'name' => 'مهندسی عمران', 'created_at' => now(), 'updated_at' => now()],
            ['education_group_id' => 2, 'name' => 'ریاضی', 'created_at' => now(), 'updated_at' => now()],
            ['education_group_id' => 2, 'name' => 'فیزیک', 'created_at' => now(), 'updated_at' => now()],
            ['education_group_id' => 3, 'name' => 'مدیریت بازرگانی', 'created_at' => now(), 'updated_at' => now()],
            ['education_group_id' => 3, 'name' => 'حسابداری', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}