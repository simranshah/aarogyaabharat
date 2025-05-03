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
        Schema::table('customers_address', function (Blueprint $table) {
            $table->string('name')->nullable()->after('city'); 
            $table->string('mobile')->nullable()->after('name'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers_address', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('mobile');
        });
    }
};
