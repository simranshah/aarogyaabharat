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
            $table->decimal('gst', 8, 2)->nullable()->after('sub_total'); 
            $table->string('razorpay_order_id')->nullable()->after('sub_total'); 
        });

        // Adding the `gst` column to the `orders` table
        Schema::table('orders', function (Blueprint $table) {
            $table->string('gst', 8, 2)->nullable()->after('amount'); 
            $table->string('razorpay_payment_id')->nullable()->after('razorpay_order_id'); 
            $table->string('razorpay_signature')->nullable()->after('razorpay_payment_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('gst');
            $table->dropColumn('razorpay_order_id');
        });

        // Dropping the `gst` column from the `orders` table
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('gst');
            $table->dropColumn('razorpay_payment_id');
            $table->dropColumn('razorpay_signature');
        });
    }
};
