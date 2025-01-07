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
            $table->id();
            $table->string('name')->nullable();
            $table->text('slug')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('sizes')->nullable();
            $table->string('image')->nullable();
            $table->string('category_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_products_tables');
    }
};
