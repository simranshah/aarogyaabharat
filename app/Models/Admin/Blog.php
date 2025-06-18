<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'title',
        'description',
        'content_html',
        'author',
        'tagname',
        'views',
        'seo_meta_tag',
        'seo_meta_tag_title',
        'page_title',
        'blog_product_ids',
    ];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
