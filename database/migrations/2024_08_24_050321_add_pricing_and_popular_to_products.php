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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('weekly_price', 8, 2)->nullable()->after('price');
            $table->decimal('monthly_price', 8, 2)->nullable()->after('weekly_price');
            $table->boolean('is_popular')->default(false)->after('monthly_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['weekly_price', 'monthly_price', 'is_popular']);
        });
    }
};
