<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('title');
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 10, 2);

            // Date range
            $table->date('start_date');
            $table->date('end_date');

            // Status
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Optional fields
            $table->string('image')->nullable();
            $table->string('target_url')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
