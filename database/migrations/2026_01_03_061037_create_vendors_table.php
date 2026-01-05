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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            // Shop Details
            $table->string('shop_name');
            $table->string('owner_name')->nullable();
            $table->string('mobile');
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('digipin', 10)->nullable();
            $table->text('address')->nullable();
            $table->string('google_map')->nullable();
            $table->string('service_area')->nullable();

            // Category & Plan
            $table->foreignId('main_category_id')->constrained('categories');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('plan_id')->constrained('plans');

            // Timing
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();

            // Social Media
            $table->json('social_links')->nullable();

            // Images
            $table->string('photo')->nullable();
            $table->json('gallery')->nullable();

            // Payment
            $table->string('payment_mode');
            $table->string('transaction_id')->nullable();
            $table->string('reference_number')->nullable();

            // Comments
            $table->text('special_recommendation')->nullable();
            $table->text('internal_comments')->nullable();

            // Approval Flow
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('approved_at')->nullable();

            // Relations
            $table->foreignId('created_by')->constrained('users'); // sales person

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
