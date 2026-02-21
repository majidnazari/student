<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name', 200);
            $table->tinyInteger('unit'); // portable
            $table->timestamps();
            $table->softDeletes();
        
            $table->unique('code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
