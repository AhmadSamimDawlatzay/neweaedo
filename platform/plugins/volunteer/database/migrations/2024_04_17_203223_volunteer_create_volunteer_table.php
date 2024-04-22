<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('status', 60)->default('inactive');
            $table->string('contract_start_date')->nullable();
            $table->string('id_card_front')->nullable();
            $table->string('id_card_back')->nullable();
            $table->string('image')->nullable();
            $table->string('cv')->nullable();
            $table->string('education_level')->nullable();
            $table->string('position')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('volunteers_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('volunteers_id');
            $table->string('name', 255)->nullable();
            $table->string('remark')->nullable();

            $table->primary(['lang_code', 'volunteers_id'], 'volunteers_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteers');
        Schema::dropIfExists('volunteers_translations');
    }
};
