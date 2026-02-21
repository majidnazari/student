<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermLessonResultSeeder extends Seeder
{
    public function run(): void
    {
        // grade_status:
        // 1=قبول 2=مردود 3=ناقص 4=حذف

        $now = now();

        // =========================
        // term_id = 1 (دانشجو 1 - ترم 1) => 4 درس * 3 واحد = 12 واحد
        // lessons: 1(CS101), 11(MATH101), 2(CS102), 14(ENG101?) -> توجه ENG101 دو واحد است؛
        // برای دقیقاً 12 واحد بهتر است فقط 3 واحدی‌ها را انتخاب کنیم:
        // 1,2,11,12  (همه 3 واحدی) => 12 واحد
        // =========================
        DB::table('term_lesson_results')->insert([
            ['term_id' => 1, 'lesson_id' => 1, 'grade' => 18.50, 'grade_status' => 1, 'coach_name' => 'دکتر حسینی', 'description' => 'عملکرد بسیار خوب', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 1, 'lesson_id' => 2, 'grade' => 17.75, 'grade_status' => 1, 'coach_name' => 'دکتر سلیمانی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 1, 'lesson_id' => 11, 'grade' => 16.25, 'grade_status' => 1, 'coach_name' => 'دکتر شریفی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 1, 'lesson_id' => 12, 'grade' => 14.00, 'grade_status' => 1, 'coach_name' => 'استاد کریمی', 'description' => 'نیاز به تمرین بیشتر', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =========================
        // term_id = 2 (دانشجو 1 - ترم 2) => 12 واحد
        // lessons: 3,4,13,6 (همه 3 واحدی) => 12
        // 3=DB, 4=SE, 13=STAT, 6=Network
        // =========================
        DB::table('term_lesson_results')->insert([
            ['term_id' => 2, 'lesson_id' => 3, 'grade' => 19.00, 'grade_status' => 1, 'coach_name' => 'دکتر حسینی', 'description' => 'پروژه عالی', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 2, 'lesson_id' => 4, 'grade' => 18.25, 'grade_status' => 1, 'coach_name' => 'دکتر رضوی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 2, 'lesson_id' => 13, 'grade' => 12.50, 'grade_status' => 2, 'coach_name' => 'دکتر شریفی', 'description' => 'افت در امتحان پایانی', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 2, 'lesson_id' => 6, 'grade' => 15.00, 'grade_status' => 1, 'coach_name' => 'دکتر کاظمی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =========================
        // term_id = 3 (دانشجو 1 - ترم 3) => 12 واحد
        // lessons: 5(OS), 7,8,9 (همه 3 واحدی) => 12
        // =========================
        DB::table('term_lesson_results')->insert([
            ['term_id' => 3, 'lesson_id' => 5, 'grade' => 16.75, 'grade_status' => 1, 'coach_name' => 'دکتر نادری', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 3, 'lesson_id' => 7, 'grade' => 17.00, 'grade_status' => 1, 'coach_name' => 'دکتر موسوی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 3, 'lesson_id' => 8, 'grade' => 18.00, 'grade_status' => 1, 'coach_name' => 'دکتر حسینی', 'description' => 'حضور و مشارکت عالی', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 3, 'lesson_id' => 9, 'grade' => 14.50, 'grade_status' => 1, 'coach_name' => 'استاد کریمی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =========================
        // term_id = 4 (دانشجو 2 - ترم 1) => 12 واحد
        // lessons: 1,2,11,12 => 12
        // =========================
        DB::table('term_lesson_results')->insert([
            ['term_id' => 4, 'lesson_id' => 1, 'grade' => 15.00, 'grade_status' => 1, 'coach_name' => 'دکتر حسینی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 4, 'lesson_id' => 2, 'grade' => 13.25, 'grade_status' => 1, 'coach_name' => 'دکتر سلیمانی', 'description' => 'نیاز به تمرین', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 4, 'lesson_id' => 11, 'grade' => 11.75, 'grade_status' => 2, 'coach_name' => 'دکتر شریفی', 'description' => 'ضعف در مبانی', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 4, 'lesson_id' => 12, 'grade' => 14.00, 'grade_status' => 1, 'coach_name' => 'دکتر شریفی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =========================
        // term_id = 5 (دانشجو 3 - ترم 1) => 12 واحد
        // lessons: 11,12,13,1 => 12
        // =========================
        DB::table('term_lesson_results')->insert([
            ['term_id' => 5, 'lesson_id' => 11, 'grade' => 19.25, 'grade_status' => 1, 'coach_name' => 'دکتر شریفی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 5, 'lesson_id' => 12, 'grade' => 18.00, 'grade_status' => 1, 'coach_name' => 'دکتر شریفی', 'description' => 'حل تمرین عالی', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 5, 'lesson_id' => 13, 'grade' => 17.50, 'grade_status' => 1, 'coach_name' => 'دکتر نظری', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 5, 'lesson_id' => 1, 'grade' => 16.00, 'grade_status' => 1, 'coach_name' => 'دکتر حسینی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // =========================
        // term_id = 6 (دانشجو 3 - ترم 2) => 12 واحد
        // lessons: 3,4,5,6 => 12
        // =========================
        DB::table('term_lesson_results')->insert([
            ['term_id' => 6, 'lesson_id' => 3, 'grade' => 18.75, 'grade_status' => 1, 'coach_name' => 'دکتر حسینی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 6, 'lesson_id' => 4, 'grade' => 17.00, 'grade_status' => 1, 'coach_name' => 'دکتر رضوی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 6, 'lesson_id' => 5, 'grade' => 16.50, 'grade_status' => 1, 'coach_name' => 'دکتر نادری', 'description' => 'پیشرفت خوب', 'created_at' => $now, 'updated_at' => $now],
            ['term_id' => 6, 'lesson_id' => 6, 'grade' => 14.25, 'grade_status' => 1, 'coach_name' => 'دکتر کاظمی', 'description' => null, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}