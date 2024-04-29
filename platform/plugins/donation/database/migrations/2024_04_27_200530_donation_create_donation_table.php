<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('remark')->nullable();
            $table->integer('amount')->nullable();
            $table->string('image')->nullable();
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('donations_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('donations_id');
            $table->string('name', 255)->nullable();
            $table->text('remark')->nullable();

            $table->primary(['lang_code', 'donations_id'], 'donations_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
        Schema::dropIfExists('donations_translations');
    }
};
