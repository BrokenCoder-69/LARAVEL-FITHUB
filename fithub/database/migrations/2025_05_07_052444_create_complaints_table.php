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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();  // Primary key for complaints
            $table->unsignedBigInteger('user_id');  // Foreign key to users table
            $table->text('complaint');  // The complaint content
            $table->enum('status', ['pending', 'resolved'])->default('pending');  // Complaint status (pending or resolved)
            $table->timestamps();  // Created and updated timestamps

            // Foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
