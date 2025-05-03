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
            $table->string('mobile')->nullable()->after('email');
            $table->string('city')->nullable()->after('mobile');
            $table->string('otp')->nullable()->after('city');
            $table->timestamp('otp_expiry')->nullable()->after('otp');
            $table->boolean('otp_verified')->default(false)->after('otp_expiry');
            $table->timestamp('otp_verified_at')->nullable()->after('otp_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'city', 'otp', 'otp_expiry', 'otp_verified', 'otp_verified_at']);
        });
    }
};
