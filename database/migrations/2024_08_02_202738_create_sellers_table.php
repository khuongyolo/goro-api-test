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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id('id')->comment('ID');
            $table->string('seller_no', 10)->unique()->comment('Seller Number');
            $table->string('name', 256)->comment('Name');
            $table->string('name_kana', 256)->nullable()->comment('Kana name');
            $table->string('zip_code', 7)->comment('Zip code');
            $table->string('address', 256)->comment('Address');
            $table->string('tel', 11)->comment('Telephone number');
            $table->string('mail', 256)->comment('Mail address');
            $table->string('password', 256)->comment('Password');
            $table->char('del_flg', 1)->default(0)->comment('Delete flag: 0 : usually, 1 : deleted');
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
        Schema::dropIfExists('sellers');
    }
};
