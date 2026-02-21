<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('college_id')->constrained('colleges');
            $table->foreignId('education_group_id')->constrained('education_groups');
            $table->foreignId('major_id')->constrained('majors');

            $table->string('student_number', 50);
            $table->string('first_name', 100);
            $table->string('last_name', 100);

            $table->string('photo_path', 500)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique('student_number');
            $table->index(['last_name', 'first_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};