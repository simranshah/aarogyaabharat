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
        Schema::create('rental_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('tenure'); // Number of months
            $table->decimal('monthly_rent', 10, 2); // Monthly rental amount
            $table->decimal('total_rent', 10, 2); // Total rent for tenure
            $table->decimal('deposit_amount', 10, 2); // 25% deposit
            $table->decimal('gst_amount', 10, 2); // GST amount
            $table->decimal('delivery_fees', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2); // Total payable
            $table->date('start_date'); // Rental start date
            $table->date('end_date'); // Rental end date
            $table->string('status')->default('active'); // active, completed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('rental_order_id')->references('id')->on('rental_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_products');
    }
};
