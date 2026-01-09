<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();

            // Current logged-in user (sender)
            $table->unsignedBigInteger('user_id');

            // Target user (receiver)
            $table->unsignedBigInteger('to_id');

            // Recommendation text
            $table->text('description');

            $table->timestamps();

            // Optional foreign keys (recommended)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
