<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('term_lesson_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('term_id')->constrained('terms')->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained('lessons');

            $table->decimal('grade', 5, 2)->nullable();
            $table->tinyInteger('grade_status')->default(1)
                ->comment('1=Passed 2=Failed 3=Incomplete 4=Withdrawn');

            $table->string('coach_name', 150)->nullable();
            $table->string('description', 500)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['term_id', 'lesson_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('term_lesson_results');
    }
};