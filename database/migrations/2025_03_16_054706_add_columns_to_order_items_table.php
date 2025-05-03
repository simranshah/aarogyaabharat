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
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('delivery_and_installation_fees', 16, 2)->default(0)->after('price');
            $table->decimal('gst', 16, 2)->default(0)->after('delivery_and_installation_fees');
            $table->decimal('maintenance', 16, 2)->default(0)->after('gst');
            $table->decimal('total_amount', 16, 2)->default(0)->after('maintenance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['delivery_and_installation_fees', 'gst', 'maintenance', 'total_amount']);
        });
    }
};
