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
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('sub_total', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->unsignedBigInteger('discount_offer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('sub_total');
            $table->dropColumn('total');
            $table->dropColumn('discount_offer_id');
        });
    }
};
