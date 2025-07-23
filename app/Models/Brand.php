<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = "brand";
    protected $fillable = [
        "name",
        "image",
        "slug"
    ];
    public function product(){
        return $this->hasMany(\App\Models\Admin\Product::class, 'brand_id', 'id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
