<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Product;

class AddRandomProductPicks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get product
        $products = Product::get();
        foreach ($products as $product) {
            // Create or Update product attributes
            $product->update([
                'product_for_you' => rand(0, 1),
                'flash_sale' => rand(0, 1),
                'best_selling_products' => rand(0, 1),
                'sports_healthcare_more' => rand(0, 1),
                'top_deals' => rand(0, 1),
                'top_pick_for_you' => rand(0, 1)
            ]);
        }
    }
}
