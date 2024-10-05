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
        Schema::create('products', function (Blueprint $table) {
            $table->id('id')->comment('ID');
            $table->string('name', 256)->comment('Name');
            $table->string('category_id', 20)->comment('Category ID');
            $table->string('store_no', 20)->comment('Store Number');
            $table->string('product_id', 20)->comment('Product ID');
            $table->char('is_frozen', 1)->comment('Is frozen? 0:fresh, 1:frozen');
            $table->char('unit', 1)->comment('Unit:1: kg, 2: g, 3: lít, 4: ml');
            $table->integer('volume')->comment('Volume');
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
        Schema::dropIfExists('products');
    }
};
