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
        Schema::table('vendors', function (Blueprint $table) {
            // $table->decimal('amount', 10, 2)->nullable()->after('reference_number');
            // $table->integer('emi_duration')->nullable()->after('amount'); // months
            // $table->decimal('emi_amount', 10, 2)->nullable()->after('emi_duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            //
        });
    }
};
