<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\orderCancelItem;

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
        'status_id', // Add status_id to fillable attributes
    ];

    public function product() // Change from products to product
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function status() // Add this method to define the relationship with Status
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
}
