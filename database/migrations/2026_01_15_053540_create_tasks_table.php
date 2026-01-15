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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('area_operator_id')->nullable()->constrained('users');
            $table->foreignId('deo_id')->nullable()->constrained('users');
            $table->foreignId('salesman_id')->nullable()->constrained('users'); 

            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
