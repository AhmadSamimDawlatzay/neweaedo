<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('donates', function (Blueprint $table) {
            $table->id();
            $table->integer('donation_id')->nullable();
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 12)->nullable();
            $table->integer('amount')->nullable();
            $table->string('currency')->nullable();
            $table->text('remark')->nullable();
            $table->string('status', 60)->default('pending');
            $table->timestamps();
        });

        Schema::create('donates_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->foreignId('donates_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'donates_id'], 'donates_translations_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donates');
        Schema::dropIfExists('donates_translations');
    }
};
