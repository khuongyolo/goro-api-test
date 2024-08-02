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
        Schema::create('address_lists', function (Blueprint $table) {
            $table->id('id')->comment('ID');
            $table->string('customer_id', 20)->comment('Customer ID');
            $table->string('name', 256)->comment('Name');
            $table->string('zip_code', 7)->comment('Zip code');
            $table->string('address', 256)->comment('Address');
            $table->string('tel', 11)->comment('Telephone number');
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
        Schema::dropIfExists('address_lists');
    }
};
