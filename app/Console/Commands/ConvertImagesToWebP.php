<?php
namespace App\Console\Commands;

use App\Models\Admin\Category;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image as InterventionImage;
use App\Models\Admin\Product;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use App\Models\Admin\Blog;
use App\Models\Admin\Image;

class ConvertImagesToWebP extends Command
{
    protected $signature = 'images:convert-webp';
    protected $description = 'Convert existing images to WebP and update database paths';

   public function handle()
    {
        $manager = new ImageManager(new GdDriver());
        $products = Product::where('image', 'NOT LIKE', '%.webp')->get();

        foreach ($products as $product) {
            $originalPath = public_path('storage/' . $product->image); // e.g., public/storage/products/image1.jpg

            if (!file_exists($originalPath)) {
                $this->warn("Missing file: $originalPath");
                continue;
            }

            try {
                $image = $manager->read($originalPath); // Read image
                $image->scale(width: 800); // Optional resize

                $filename = pathinfo($originalPath, PATHINFO_FILENAME) . '.webp';
                $relativeDir = dirname($product->image); // e.g., products
                $newRelativePath = $relativeDir . '/' . $filename;
                $newFullPath = public_path('storage/' . $newRelativePath);

                // Save as WebP
                file_put_contents($newFullPath, (string) $image->toWebp(50));

                // Update DB to point to the web-accessible path
                $product->image = $newRelativePath;
                $product->save();

                $this->info("✅ Converted: {$product->image}");
            } catch (\Exception $e) {
                $this->error("❌ Error processing {$product->image}: " . $e->getMessage());
            }
        }
        Category::whereNotNull('image') ->where('image', 'NOT LIKE', '%.webp')->get()->each(function ($category) use ($manager) {
            $originalPath = public_path('storage/' . $category->image);

            if (!file_exists($originalPath)) {
                $this->warn("Missing file: $originalPath");
                return;
            }

            try {
                $image = $manager->read($originalPath);
                $image->scale(width: 800);

                $filename = pathinfo($originalPath, PATHINFO_FILENAME) . '.webp';
                $relativeDir = dirname($category->image);
                $newRelativePath = $relativeDir . '/' . $filename;
                $newFullPath = public_path('storage/' . $newRelativePath);

                file_put_contents($newFullPath, (string) $image->toWebp(50));

                $category->image = $newRelativePath;
                $category->save();

                $this->info("✅ Converted: {$category->image}");
            } catch (\Exception $e) {
                $this->error("❌ Error processing {$category->image}: " . $e->getMessage());
            }
        });
        Banner::whereNotNull('image') ->where('image', 'NOT LIKE', '%.webp')->get()->each(function ($banner) use ($manager) {
            $originalPath = public_path('storage/' . $banner->image);

            if (!file_exists($originalPath)) {
                $this->warn("Missing file: $originalPath");
                return;
            }

            try {
                $image = $manager->read($originalPath);
                $image->scale(width: 800);

                $filename = pathinfo($originalPath, PATHINFO_FILENAME) . '.webp';
                $relativeDir = dirname($banner->image);
                $newRelativePath = $relativeDir . '/' . $filename;
                $newFullPath = public_path('storage/' . $newRelativePath);

                file_put_contents($newFullPath, (string) $image->toWebp(50));

                $banner->image = $newRelativePath;
                $banner->save();

                $this->info("✅ Converted: {$banner->image}");
            } catch (\Exception $e) {
                $this->error("❌ Error processing {$banner->image}: " . $e->getMessage());
            }
        });
        $blogImages = Image::where('imageable_type', Blog::class)->get();
        foreach ($blogImages as $blogImage) {
            $originalPath = public_path('storage/' . $blogImage->path);

            if (!file_exists($originalPath)) {
                $this->warn("Missing file: $originalPath");
                continue;
            }

            try {
                $image = $manager->read($originalPath);
                $image->scale(width: 800);

                $filename = pathinfo($originalPath, PATHINFO_FILENAME) . '.webp';
                $relativeDir = dirname($blogImage->path);
                $newRelativePath = $relativeDir . '/' . $filename;
                $newFullPath = public_path('storage/' . $newRelativePath);

                file_put_contents($newFullPath, (string) $image->toWebp(50));

                $blogImage->path = $newRelativePath;
                $blogImage->save();

                $this->info("✅ Converted: {$blogImage->path}");
            } catch (\Exception $e) {
                $this->error("❌ Error processing {$blogImage->path}: " . $e->getMessage());
            }
        }

        $this->info('🎉 All images processed.');
    }
}
