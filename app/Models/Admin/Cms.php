<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',  
        'title',  
        'description',  
        'image',  
        'content', 
        'is_active'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
