<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use App\Models\Admin\ProductAttribute;

class ProductStockUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         // Define possible values
         $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
         $colors = ['Red', 'Blue', 'Green', 'Black', 'White'];
         $materials = ['Cotton', 'Polyester', 'Leather', 'Plastic', 'Wood', 'Metal'];
         $brands = ['Nike', 'Adidas', 'Puma', 'Reebok', 'Generic'];
         
        // get product
        $products = Product::get();
        foreach ($products as $product) {
            // Create or Update product attributes
            ProductAttribute::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'stock' => rand(500, 2000),
                    'size' => $sizes[array_rand($sizes)],
                    'color' => $colors[array_rand($colors)],
                    'weight' => rand(100, 1000) . 'g',
                    'material' => $materials[array_rand($materials)],
                    'brand' => $brands[array_rand($brands)],
                    'model_number' => 'MOD-' . rand(1000, 9999),
                    'expiration_date' => now()->addDays(rand(30, 365))->toDateString(),
                ]
            );
        }
    }
}
