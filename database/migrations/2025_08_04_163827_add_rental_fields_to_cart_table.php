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
            $table->boolean('is_rental')->default(false);
            $table->string('tenure')->nullable()->after('is_rental');
            $table->decimal('base_amount', 10, 2)->nullable()->after('tenure');
            $table->decimal('gst_amount', 10, 2)->nullable()->after('base_amount');
            $table->decimal('delivery_fees', 10, 2)->nullable()->after('gst_amount');
            $table->date('last_rental_date')->nullable()->after('delivery_fees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn([
                'is_rental',
                'tenure',
                'base_amount',
                'gst_amount',
                'delivery_fees',
                'last_rental_date'
            ]);
        });
    }
};
