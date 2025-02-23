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
        Schema::table('users', function (Blueprint $table) {
<<<<<<< HEAD
            $table->string('pin_code', 10)->nullable()->after('pincode_id'); // Adjust the "after" column as needed
=======
            $table->string('pin_code', 10)->nullable()->after('pincode_id'); 
>>>>>>> 38c116d (23022025 commit changes)
            $table->string('state')->nullable()->after('pin_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pin_code', 'state']);
        });
    }
};
