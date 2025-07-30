<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'slug',
        'image_1',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
