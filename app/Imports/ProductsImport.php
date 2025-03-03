<?php

namespace App\Imports;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
<<<<<<< HEAD
    public function model(array $row)
    {
        // Handle Category Image
        // dd($row);
        $categoryImagePath = null;
        if (!empty($row['c_image']) && file_exists($row['c_image'])) {
            $categoryImagePath = Storage::disk('public')->putFile('categories', new \Illuminate\Http\File($row['c_image']));
        }

        // Find or create the category
        $category = Category::updateOrCreate(
            ['name' => trim($row['category'])],
            ['slug' => \Str::slug(trim($row['category']))]
        );

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
            'category_id' => $category->id,
            'name' => trim($row['product_name'] ?? ''),
            'title' => trim($row['title'] ?? null),
            'image' => 'default.jpg', // Temporary placeholder
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
=======
    /**
     * Handle the import row and create a product.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
     
    public function model(array $row)
    {
        // Validate and upload category image
        $categoryImagePath = $this->storeImage($row['c_image'] ?? null, 'categories');

        // Find or create the category
        // dd($row['category_name']);
        // dd($row['category_name'], strlen($row['category_name']));

        $category = Category::firstOrCreate(
            ['name' => $row['category_name']],
            [
                'image' => $categoryImagePath,
                'slug' => Str::slug($row['category_name']),
            ]
        );

        // Validate and upload product image
        $productImagePath = $this->storeImage($row['image'] ?? null, 'products');

        // Create and return the product
        return new Product([
            'category_id' => $category->id,
            'name' => $row['product_name'],
            'title' => $row['title'],
            'image' => $productImagePath,
            'slug' => Str::slug($row['product_name']),
            'description' => $row['description'],
            'features_specification' => $row['features_specification'],
            'price' => $row['price'],
            'weekly_price' => $row['weekly_price'],
            'monthly_price' => $row['monthly_price'],
            'gst' => $row['gst'],
            'is_popular' => $row['is_popular'],
            'about_item' => $row['about_item'],
            'is_rentable' => $row['is_rentable'],
            'is_new' => $row['is_new'],
>>>>>>> 38c116d (23022025 commit changes)
        ]);

        // **Now handle product images**

        $url = $row['product_image_url'] ?? null;
        $path = parse_url($url, PHP_URL_PATH);
        $host = parse_url($url, PHP_URL_HOST);
        if ($host == $_SERVER['HTTP_HOST']) {
        $pos = strpos( $path, 'product/');
        $finalPath = substr($path, $pos + strlen('product/'));
        // echo $finalPath.'<br>';
        $finalPath = str_replace('/products/', '', $finalPath);
        $newPath = 'products/' . $finalPath ;
        $product->update(['image' => $newPath]);
        }else{
        if (!empty($row['product_image_url'])) {
            $extension = pathinfo($row['product_image_url'], PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $extension;
            $newPath = 'products/' . $newFileName;

            Storage::disk('public')->put($newPath, file_get_contents($row['product_image_url']));

            $product->images()->create([
                'path' =>  $newPath,
                'alt' => $row['image_alt'] ?? null,
            ]);

            // **Optional: Update Product Main Image**
            $product->update(['image' =>  $newPath]);
        }
    }

            $product->productAttributes()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'stock' => $cleanNumeric($row['stock'] ?? rand(500, 2000)),
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

    /**
     * Store an image and return its path.
     *
     * @param string|null $url
     * @param string $folder
     * @return string|null
     */
    private function storeImage(?string $url, string $folder): ?string
    {
        if ($url && @file_get_contents($url)) {
            $fileContents = file_get_contents($url);
            $fileName = $folder . '/' . basename($url);
            Storage::disk('public')->put($fileName, $fileContents);
            return $fileName;
        }

        return null;
    }
}
