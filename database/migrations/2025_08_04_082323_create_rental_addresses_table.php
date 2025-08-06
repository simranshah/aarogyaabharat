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
        Schema::create('rental_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rental_order_id');
            $table->string('house_number')->nullable();
            $table->string('society_name')->nullable();
            $table->string('locality')->nullable();
            $table->string('landmark')->nullable();
            $table->string('pincode');
            $table->string('city');
            $table->string('state');
            $table->string('phone')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->enum('address_type', ['home', 'office', 'other'])->default('home');
            $table->boolean('is_delivery_address')->default(true);
            $table->timestamps();

            $table->foreign('rental_order_id')->references('id')->on('rental_orders')->onDelete('cascade');
            $table->index(['rental_order_id', 'is_delivery_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_addresses');
    }
};
