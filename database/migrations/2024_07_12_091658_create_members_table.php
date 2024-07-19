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
        Schema::create('members', function (Blueprint $table) {
            $table->id('id')->comment('ID');
            $table->string('username', 6)->comment('User Name');
            $table->string('password', 100)->comment('Password');
            $table->string('email', 255)->comment('Mail Address');
            $table->dateTime('createdate')->comment('Create Date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
