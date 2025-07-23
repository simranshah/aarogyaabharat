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
            $table->string('gender')->nullable(); // Replace 'some_existing_column' with the actual column name after which you want to add
            // $table->string('brand_name')->nullable()->after('gender');
            $table->unsignedBigInteger('subcategory_id')->nullable()->after('gender');
            $table->decimal('rating', 3, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['gender', 'rating']);
        });
    }
};
