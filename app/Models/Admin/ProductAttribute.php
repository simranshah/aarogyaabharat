<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'products_attributes';
    protected $fillable = [
        'product_id',
        'stock',
        'size',
        'color',
        'weight',
        'material',
        'brand',
        'model_number',
        'expiration_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
