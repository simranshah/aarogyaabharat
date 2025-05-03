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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('otp')->after('image')->nullable();
            $table->timestamp('otp_expiry')->after('otp')->nullable();
            $table->boolean('otp_verified')->after('otp_expiry')->default(false);
            $table->timestamp('otp_verified_at')->after('otp_verified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('otp');
            $table->dropColumn('otp_expiry');
            $table->dropColumn('otp_verified');
            $table->dropColumn('otp_verified_at');
        });
    }
};
