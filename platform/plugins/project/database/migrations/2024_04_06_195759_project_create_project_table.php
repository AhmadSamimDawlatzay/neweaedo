<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('projects_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('projects_id',155);
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'projects_id'], 'projects_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('projects_translations');
    }
};
