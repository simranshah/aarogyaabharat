<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'title',
        'image',
        'slug',
        'description',
        'features_specification',
        'price',
        'gst',
        'about_item',
        'weekly_price',      
        'monthly_price',      
        'is_rentable',     
        'is_popular',      
        'is_new',          
        'discount_percentage',          
        'page_title',          
        'seo_meta_tag_title',          
        'seo_meta_tag',          
        'delivery_and_installation_fees',
        'image_alt', 
        'original_price', 
        'our_price', 
        'maintenance', 
        'product_for_you', 
        'flash_sale', 
        'best_selling_products', 
        'sports_healthcare_more', 
        'top_deals', 
        'top_pick_for_you', 
        'measurements', 
        'usage_instructions', 
        'why_choose_this_product'          
    ];
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productAttributes()
    {
        return $this->hasOne(ProductAttribute::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

