<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('payment_installments', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('installment_number');
            $table->boolean('is_overdue')->default(false)->after('due_date');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_installments', function (Blueprint $table) {
            //
        });
    }
};
