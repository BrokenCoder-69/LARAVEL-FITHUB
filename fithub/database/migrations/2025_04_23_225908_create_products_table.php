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
            $table->id();  // Primary key
            $table->string('name');  // Product name
            $table->text('description');  // Product description
            $table->decimal('price', 8, 2);  // Product price
            $table->string('category');  // Category (e.g., supplements, workout gear)
            $table->string('image_url')->nullable();  // URL for product image (optional)
            $table->integer('stock_quantity')->default(0);  // Quantity in stock
            $table->timestamps();  // Created at and updated at timestamps
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
