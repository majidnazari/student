<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lessons')->insert([
            // 3 واحدی‌ها (برای اینکه راحت 12 واحد بسازیم)
            ['code' => 'CS101', 'name' => 'مبانی برنامه‌نویسی', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS102', 'name' => 'ساختمان داده', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS201', 'name' => 'پایگاه داده', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS202', 'name' => 'مهندسی نرم‌افزار', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS203', 'name' => 'سیستم عامل', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS204', 'name' => 'شبکه‌های کامپیوتری', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS205', 'name' => 'تحلیل و طراحی سیستم', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS206', 'name' => 'الگوریتم‌ها', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS207', 'name' => 'برنامه‌نویسی وب', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CS208', 'name' => 'آزمایشگاه پایگاه داده', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],

            ['code' => 'MATH101', 'name' => 'ریاضی عمومی ۱', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'MATH102', 'name' => 'ریاضی عمومی ۲', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'STAT201', 'name' => 'آمار و احتمال', 'unit' => 3, 'created_at' => now(), 'updated_at' => now()],

            // 2 واحدی (اختیاری)
            ['code' => 'ENG101', 'name' => 'زبان تخصصی', 'unit' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'UNI101', 'name' => 'آیین زندگی', 'unit' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}