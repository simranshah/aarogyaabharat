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
        Schema::table('rental_orders', function (Blueprint $table) {
            $table->decimal('deposit')->default(0);
            // 10,2 means max 99999999.99, adjust as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_orders', function (Blueprint $table) {
            $table->dropColumn('deposit');
        });
    }
};
