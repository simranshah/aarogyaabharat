<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {

        Schema::table('products', function (Blueprint $table) {
            $table->string('image_alt')->nullable()->after('image');
            $table->decimal('original_price', 10, 2)->nullable()->after('price');
            $table->decimal('our_price', 10, 2)->nullable()->after('original_price');
            $table->decimal('maintenance', 10, 2)->nullable()->after('monthly_price');
            $table->boolean('product_for_you')->default(0)->after('is_new');
            $table->boolean('flash_sale')->default(0)->after('product_for_you');
            $table->boolean('best_selling_products')->default(0)->after('flash_sale');
            $table->boolean('sports_healthcare_more')->default(0)->after('best_selling_products');
            $table->boolean('top_deals')->default(0)->after('sports_healthcare_more');
            $table->boolean('top_pick_for_you')->default(0)->after('top_deals');
            $table->text('measurements')->nullable()->after('top_pick_for_you');
            $table->text('usage_instructions')->nullable()->after('measurements');
            $table->text('why_choose_this_product')->nullable()->after('usage_instructions');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                 'image_alt', 'original_price', 'our_price', 'maintenance', 'product_for_you', 'flash_sale', 
                'best_selling_products', 'sports_healthcare_more', 'top_deals', 
                'top_pick_for_you', 'measurements', 'usage_instructions', 'why_choose_this_product'
            ]);
        });
    }
};
