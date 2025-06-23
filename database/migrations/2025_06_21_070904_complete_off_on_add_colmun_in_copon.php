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
        Schema::table('offers_and_discounts', function (Blueprint $table) {
            $table->text('complete_off_on')->nullable()->after('value'); // Adjust 'after' as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers_and_discounts', function (Blueprint $table) {
            $table->dropColumn('complete_off_on');
        });
    }
};
