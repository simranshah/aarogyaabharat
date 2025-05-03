<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'gst',
        'delivery_and_installation_fees',
        'maintenance',
        'total_amount',
    ];

    public function product() // Change from products to product
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
