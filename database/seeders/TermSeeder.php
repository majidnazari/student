<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        /*
        دانشجو 1 (id=1) → 3 ترم
        دانشجو 2 (id=2) → 1 ترم
        دانشجو 3 (id=3) → 2 ترم
        */

        DB::table('terms')->insert([

            // ======================
            // دانشجو 1
            // ======================
            [
                'student_id' => 1,
                'term_number' => 1,
                'start_date' => '2025-09-23',
                'end_date' => '2026-01-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'student_id' => 1,
                'term_number' => 2,
                'start_date' => '2026-02-10',
                'end_date' => '2026-06-10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'student_id' => 1,
                'term_number' => 3,
                'start_date' => '2026-09-23',
                'end_date' => '2027-01-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // ======================
            // دانشجو 2
            // ======================
            [
                'student_id' => 2,
                'term_number' => 1,
                'start_date' => '2025-09-23',
                'end_date' => '2026-01-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // ======================
            // دانشجو 3
            // ======================
            [
                'student_id' => 3,
                'term_number' => 1,
                'start_date' => '2025-09-23',
                'end_date' => '2026-01-20',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'student_id' => 3,
                'term_number' => 2,
                'start_date' => '2026-02-10',
                'end_date' => '2026-06-10',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}