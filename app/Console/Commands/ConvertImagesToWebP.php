<?php
namespace App\Console\Commands;

use App\Models\Admin\Category;
use Illuminate\Console\Command;
use App\Models\Admin\Product;
use App\Models\Banner;
use App\Models\Admin\Blog;
use App\Models\Admin\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ConvertImagesToWebP extends Command
{
    protected $signature = 'images:convert-webp';
    protected $description = 'Convert existing images to WebP, compress only if >40KB, and update database paths';
    
    // Compression quality for images > 40KB
    protected $compressionQuality = 75;
    // Normal quality for images <= 40KB (100 means no compression)
    protected $normalQuality = 100;
    // Size threshold for compression (40KB in bytes)
    protected $sizeThreshold = 40000;
    // Target width for resizing
    protected $targetWidth = 800;

    public function handle()
    {
        $manager = new ImageManager(new GdDriver());
        
        // Process Products
        $this->processModelImages(
            $manager,
            Product::where('image', 'NOT LIKE', '%.webp')->get(),
            'image'
        );
        
        // Process Categories
        $this->processModelImages(
            $manager,
            Category::whereNotNull('image')->where('image', 'NOT LIKE', '%.webp')->get(),
            'image'
        );
        
        // Process Banners
        $this->processModelImages(
            $manager,
            Banner::whereNotNull('image')->where('image', 'NOT LIKE', '%.webp')->get(),
            'image'
        );
        
        // Process Blog Images
        $blogImages = Image::where('imageable_type', Blog::class)
            ->where('path', 'NOT LIKE', '%.webp')
            ->get();
            
        foreach ($blogImages as $blogImage) {
            $originalPath = public_path('storage/' . $blogImage->path);

            if (!file_exists($originalPath)) {
                $this->warn("Missing file: $originalPath");
                continue;
            }

            try {
                $originalSize = filesize($originalPath);
                // Only compress if image is larger than threshold
                $quality = $originalSize > $this->sizeThreshold 
                    ? $this->compressionQuality 
                    : $this->normalQuality;

                $image = $manager->read($originalPath);
                $image->scale(width: $this->targetWidth);

                $filename = pathinfo($originalPath, PATHINFO_FILENAME) . '.webp';
                $relativeDir = dirname($blogImage->path);
                $newRelativePath = $relativeDir . '/' . $filename;
                $newFullPath = public_path('storage/' . $newRelativePath);

                file_put_contents($newFullPath, (string) $image->toWebp($quality));

                // Delete original file if successful
                if (file_exists($newFullPath)) {
                    unlink($originalPath);
                }

                $blogImage->path = $newRelativePath;
                $blogImage->save();

                $newSize = filesize($newFullPath);
                $savings = $originalSize - $newSize;
                $savingsPercent = round(($savings / $originalSize) * 100, 2);

                $this->info(sprintf(
                    "✅ Converted: %s | Quality: %d%% | Original: %s | New: %s | Saved: %s (%d%%)",
                    $blogImage->path,
                    $quality,
                    $this->formatBytes($originalSize),
                    $this->formatBytes($newSize),
                    $this->formatBytes($savings),
                    $savingsPercent
                ));
            } catch (\Exception $e) {
                $this->error("❌ Error processing {$blogImage->path}: " . $e->getMessage());
            }
        }

        $this->info('🎉 All images processed.');
    }
    
    /**
     * Process images for a given model collection
     */
    protected function processModelImages($manager, $models, $imageField)
    {
        foreach ($models as $model) {
            $originalPath = public_path('storage/' . $model->{$imageField});

            if (!file_exists($originalPath)) {
                $this->warn("Missing file: $originalPath");
                continue;
            }

            try {
                $originalSize = filesize($originalPath);
                // Only compress if image is larger than threshold
                $quality = $originalSize > $this->sizeThreshold 
                    ? $this->compressionQuality 
                    : $this->normalQuality;

                $image = $manager->read($originalPath);
                $image->scale(width: $this->targetWidth);

                $filename = pathinfo($originalPath, PATHINFO_FILENAME) . '.webp';
                $relativeDir = dirname($model->{$imageField});
                $newRelativePath = $relativeDir . '/' . $filename;
                $newFullPath = public_path('storage/' . $newRelativePath);

                file_put_contents($newFullPath, (string) $image->toWebp($quality));

                // Delete original file if successful
                if (file_exists($newFullPath)) {
                    unlink($originalPath);
                }

                $model->{$imageField} = $newRelativePath;
                $model->save();

                $newSize = filesize($newFullPath);
                $savings = $originalSize - $newSize;
                $savingsPercent = round(($savings / $originalSize) * 100, 2);

                $this->info(sprintf(
                    "✅ Converted: %s | Quality: %d%% | Original: %s | New: %s | Saved: %s (%d%%)",
                    $model->{$imageField},
                    $quality,
                    $this->formatBytes($originalSize),
                    $this->formatBytes($newSize),
                    $this->formatBytes($savings),
                    $savingsPercent
                ));
            } catch (\Exception $e) {
                $this->error("❌ Error processing {$model->{$imageField}}: " . $e->getMessage());
            }
        }
    }
    
    /**
     * Format bytes to human-readable format
     */
    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}