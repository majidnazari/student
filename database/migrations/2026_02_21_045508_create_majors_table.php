<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_group_id')->constrained('education_groups');
            $table->string('name', 200);
            $table->timestamps();

            $table->unique(['education_group_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};