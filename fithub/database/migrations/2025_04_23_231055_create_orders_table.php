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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key for the user who placed the order
            $table->decimal('total_price', 8, 2);  // Total price of the order
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');  // Order status
            $table->string('shipping_name');  // Name of the person receiving the order
            $table->text('shipping_address');  // Shipping address
            $table->string('shipping_phone');  // Shipping phone number
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
