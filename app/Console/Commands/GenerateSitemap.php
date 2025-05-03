<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Product;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sitemap for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $urls = [];
    
        // Static pages
        $staticPages = [
           
            '/about-us',
            '/contact-us',
            '/privacy-policy',
            '/terms-and-conditions',
            '/faqs',
            '/blogs',
            '/products',
            '/cart',
            '/profile',
            '/categories',
        ];
        $urls[] = [
            'loc' => url('/'),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '1.0',
        ];
        foreach ($staticPages as $url) {
            $urls[] = [
                'loc' => url($url),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ];
        }
    
        // Dynamic Products
        foreach (\App\Models\Admin\Product::with('images', 'category')->get() as $product) {
            $urls[] = [
                'loc' => url("/categories/{$product->category->slug}/{$product->slug}"),
                'lastmod' => $product->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }
        
    
        // Dynamic Categories
        foreach (\App\Models\Admin\Category::all() as $category) {
            $urls[] = [
                'loc' => url("/categories/{$category->slug}"),
                'lastmod' => $category->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }
    
        // Dynamic Blogs
        foreach (\App\Models\Admin\Blog::all() as $blog) {
            $urls[] = [
                'loc' => url("/blogs/details/{$blog->slug}"),
                'lastmod' => $blog->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }
    
        // Build XML
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n";
        $xml .= "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n";
        $xml .= "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n";
        $xml .= "        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";

    
        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url['loc']}</loc>\n";
            $xml .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }
    
        $xml .= "</urlset>";
    
        file_put_contents(public_path('sitemap.xml'), $xml);
    
        $this->info('Custom sitemap generated successfully with all fields.');
    }
    

}
