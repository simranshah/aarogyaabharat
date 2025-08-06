<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;

class CartProduct extends Model
{
    use HasFactory;

    protected $casts = [
        'is_rental' => 'boolean',
        'base_amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'delivery_fees' => 'decimal:2',
        'last_rental_date' => 'date',
    ];

    protected $fillable = [
        'cart_id',
        'product_id',
        'price',
        'quantity',
        'total_price',
        'is_visible',
        'is_rental',
        'tenure',
        'base_amount',
        'gst_amount',
        'delivery_fees',
        'last_rental_date',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
