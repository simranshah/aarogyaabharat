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
        Schema::create('happy_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Customer's name
            $table->text('comment'); // Customer's comment/testimonial
            $table->unsignedTinyInteger('rate'); // Rating, typically 1-5
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('happy_customers');
    }
};
