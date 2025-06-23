<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\User; 
use App\Models\Front\CartProduct;
use App\Models\Admin\OfferAndDiscount;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'product_id',
        'quantity',
        'price',
        'sub_total',
        'total',
        'discount_offer_id',
        'gst',
        'total_gst',
        'razorpay_order_id',
        'total_delivery_charges',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }

    public function offer()
    {
        return $this->belongsTo(OfferAndDiscount::class, 'discount_offer_id');
    }
}
