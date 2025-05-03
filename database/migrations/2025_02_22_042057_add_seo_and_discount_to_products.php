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
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->string('page_title')->nullable();
            $table->string('seo_meta_tag_title')->nullable();
            $table->text('seo_meta_tag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'discount_percentage',
                'page_title',
                'seo_meta_tag_title',
                'seo_meta_tag'
            ]);
        });
    }
};
