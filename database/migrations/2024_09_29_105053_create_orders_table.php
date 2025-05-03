<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_order_id')->nullable();
            $table->foreignId('cart_id')->nullable()->constrained('carts')->onDelete('set null');
            $table->foreignId('offer_id')->nullable()->constrained('offers_and_discounts')->onDelete('set null');
            $table->decimal('amount', 10, 2); 
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->constrained('status')->onDelete('set null');
            $table->text('payment_response')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
