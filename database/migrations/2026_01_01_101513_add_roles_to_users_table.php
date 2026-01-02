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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'area_operator',
                'deo',
                'salesman',
                'user'
            ])->default('user');

            $table->foreignId('area_operator_id')->nullable()->constrained('users');
            $table->foreignId('deo_id')->nullable()->constrained('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
