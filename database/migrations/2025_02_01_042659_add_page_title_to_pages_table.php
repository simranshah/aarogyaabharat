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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('page_title')->nullable()->after('title_tag');
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('page_title')->nullable()->after('seo_meta_tag_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('page_title');
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('page_title');
        });
    }
};
