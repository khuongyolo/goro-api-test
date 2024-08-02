<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('word_infos', function (Blueprint $table) {
            $table->id('id', 20)->comment('ID');
            $table->string('word_id', 20)->comment('Word ID');
            $table->string('language_id', 20)->comment('Language ID');
            $table->dateTime('created_at')->comment('Created at');
            $table->string('create_user', 20)->comment('Created by user');
            $table->dateTime('updated_at')->nullable()->comment('Updated at');
            $table->string('update_user', 20)->nullable()->comment('Updated by user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_infos');
    }
};
