<?php

namespace App\Imports;

use App\Models\Admin\Category;
use App\Models\Admin\SubCategories;
use App\Models\Brand;
use App\Models\Admin\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Storage;


class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Handle Category Image
        // dd($row);
        set_time_limit(3000); // 300 seconds = 5 minutes

        $categoryImagePath = null;
        if (!empty($row['c_image']) && file_exists($row['c_image'])) {
            $categoryImagePath = Storage::disk('public')->putFile('categories', new \Illuminate\Http\File($row['c_image']));
        }

        // Find or create the category
        $category = Category::updateOrCreate(
            ['name' => trim($row['category'])],
            ['slug' => \Str::slug(trim($row['category']))]
        );

        // $subcategory = SubCategories::updateOrCreate(
        //     [   
        //         'category_id' => $category->id,
        //         'name' => substr(trim($row['subcategory_name']), 0, 20)
        //     ],
        //     [
        //         'slug' => \Str::slug(substr(trim($row['subcategory_name']), 0, 20))
        //     ]
        // );
        // $brand = Brand::updateOrCreate(
        //     ['name' => trim($row['brand'])],
        //     ['slug' => \Str::slug(trim($row['brand']))]
        // );

        // Function to clean numeric values
        $cleanNumeric = function ($value) {
            if (is_numeric($value)) {
                return (float) $value;
            }
            return (float) preg_replace('/[^0-9.]/', '', $value); 
        };

        // **First, create the product**
        $product = Product::updateOrCreate(
            [
                'category_id' => $category->id,
                'name' => trim($row['product_name'])
            ],
            [
            // 'subcategory_id' => $subcategory->id,
            // 'brand_id' => $brand->id,
            'category_id' => $category->id,
            'name' => trim($row['product_name'] ?? ''),
            'title' => trim($row['title'] ?? null),
            // 'image' => 'default.jpg', // Temporary placeholder
            'image_alt' => trim($row['image_alt'] ?? null),
            'slug' => \Str::slug(trim($row['product_name'] ?? 'default-product')),
            'description' => trim($row['description'] ?? null),
            'features_specification' => trim($row['features_specification'] ?? null),
            'about_item' => trim($row['about_item'] ?? null),
            'original_price' => $cleanNumeric($row['original_price'] ?? 0),
            'price' => $cleanNumeric($row['original_price'] ?? 0),
            'our_price' => ((float) trim($row['original_price']) - ((float) trim($row['original_price']) * (float) trim($row['product_discount']) / 100)),
            'discount_percentage' => $cleanNumeric($row['product_discount']  ?? 0),
            'delivery_and_installation_fees' => $cleanNumeric($row['delivery_and_installation_fees'] ?? 0),
            'gst' => $cleanNumeric($row['gst_percentage'] ?? 0),
            'monthly_price' => $cleanNumeric($row['monthly_price'] ?? 0),
            'maintenance' => $cleanNumeric($row['maintenance'] ?? 0),
            'is_rentable' => isset($row['is_rentable']) && $row['is_rentable'] ? 1 : 0,
            'rent_tenur' => ($row['rent_tenur'] ?? 0),
            'renting_presentag' => ($row['renting_presentag'] ?? 0),
            'is_popular' => isset($row['is_popular']) && $row['is_popular'] ? 1 : 0,
            'is_new' => isset($row['is_new']) && $row['is_new'] ? 1 : 0,
            'product_for_you' => isset($row['product_for_you']) && $row['product_for_you'] ? 1 : 0,
            'flash_sale' => isset($row['flash_sale']) && $row['flash_sale'] ? 1 : 0,
            'best_selling_products' => isset($row['best_selling_products']) && $row['best_selling_products'] ? 1 : 0,
            'sports_healthcare_more' => isset($row['sports_healthcare_more']) && $row['sports_healthcare_more'] ? 1 : 0,
            'top_deals' => isset($row['top_deals']) && $row['top_deals'] ? 1 : 0,
            'top_pick_for_you' => isset($row['top_pick_for_you']) && $row['top_pick_for_you'] ? 1 : 0,
            'measurements' => trim($row['measurements'] ?? null),
            'usage_instructions' => trim($row['usage_instructions'] ?? null),
            'why_choose_this_product' => trim($row['why_choose_this_product'] ?? null),
            'page_title' => trim($row['page_title_head'] ?? null),
            'seo_meta_tag_title' => trim($row['seo_meta_tag_title'] ?? null),
            'seo_meta_tag' => trim($row['seo_meta_tag_description'] ?? null),
            
        ]);

        // **Now handle product images**

    //     $url = $row['product_image_url'] ?? null;
    //     $path = parse_url($url, PHP_URL_PATH);
    //     $host = parse_url($url, PHP_URL_HOST);
    //     if ($host == $_SERVER['HTTP_HOST']) {
    //     $pos = strpos( $path, 'product/');
    //     $finalPath = substr($path, $pos + strlen('product/'));
    //     // echo $finalPath.'<br>';
    //     $finalPath = str_replace('/products/', '', $finalPath);
    //     $newPath = 'products/' . $finalPath ;
    //     $product->update(['image' => $newPath]);
    //     }else{
    //     if (!empty($row['product_image_url'])) {
    //         $extension = pathinfo($row['product_image_url'], PATHINFO_EXTENSION);
    //         $newFileName = uniqid() . '.' . $extension;
    //         $newPath = 'products/' . $newFileName;

    //         Storage::disk('public')->put($newPath, file_get_contents($row['product_image_url']));

    //         $product->images()->create([
    //             'path' =>  $newPath,
    //             'alt' => $row['image_alt'] ?? null,
    //         ]);

    //         // **Optional: Update Product Main Image**
    //         $product->update(['image' =>  $newPath]);
    //     }
    // }

            $product->productAttributes()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'stock' => $cleanNumeric($row['stock'] ?? rand(0,0)),
                    'size' => ['S', 'M', 'L', 'XL', 'XXL'][array_rand(['S', 'M', 'L', 'XL', 'XXL'])],
                    'color' => ['Red', 'Blue', 'Green', 'Black', 'White'][array_rand(['Red', 'Blue', 'Green', 'Black', 'White'])],
                    'weight' => rand(100, 1000) . 'g',
                    'material' => ['Cotton', 'Polyester', 'Leather', 'Plastic'][array_rand(['Cotton', 'Polyester', 'Leather', 'Plastic'])],
                    'brand' => ['Nike', 'Adidas', 'Puma', 'Reebok', 'Generic'][array_rand(['Nike', 'Adidas', 'Puma', 'Reebok', 'Generic'])],
                    'model_number' => 'MOD-' . rand(1000, 9999),
                    'expiration_date' => now()->addDays(rand(30, 365))->toDateString(),
                ]
            );    
     
        return $product;
    }
}
