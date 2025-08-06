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
        Schema::create('rental_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_product_id');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('month_number'); // 1, 2, 3, etc.
            $table->decimal('amount', 10, 2); // Monthly rent amount
            $table->date('due_date'); // When payment is due
            $table->date('paid_date')->nullable(); // When payment was made
            $table->string('status')->default('pending'); // pending, paid, overdue, waived
            $table->string('payment_method')->nullable(); // razorpay, cash, etc.
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('rental_product_id')->references('id')->on('rental_products')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['rental_product_id', 'month_number']);
            $table->index(['user_id', 'status']);
            $table->index(['due_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_payments');
    }
};
