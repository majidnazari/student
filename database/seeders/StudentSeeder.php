<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // فرض: colleges به ترتیب: 1=مهندسی، 2=علوم پایه، 3=مدیریت
        // فرض: education_groups: 1=مهندسی، 2=علوم پایه، 3=مدیریت
        // majors: 1=مهندسی نرم‌افزار، 2=عمران، 3=ریاضی، 4=فیزیک، 5=بازرگانی، 6=حسابداری

        DB::table('students')->insert([
            [
                'college_id' => 1,
                'education_group_id' => 1,
                'major_id' => 1,
                'student_number' => '40123456', // عدد انگلیسی
                'first_name' => 'علی',
                'last_name' => 'احمدی',
                'photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'college_id' => 1,
                'education_group_id' => 1,
                'major_id' => 1,
                'student_number' => '40123457',
                'first_name' => 'نگار',
                'last_name' => 'محمدی',
                'photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'college_id' => 2,
                'education_group_id' => 2,
                'major_id' => 3,
                'student_number' => '40130001',
                'first_name' => 'سارا',
                'last_name' => 'رضایی',
                'photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}