<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RentalAddress;
use App\Models\Admin\Product;

class RentalOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'tenure',
        'last_rental_date',
        'base_amount',
        'gst_amount',
        'delivery_fees',
        'total_amount',
        'razorpay_order_id',
        'razorpay_payment_id',
        'status',
        'payment_verified_at'
    ];

    protected $casts = [
        'payment_verified_at' => 'datetime',
        'last_rental_date' => 'date',
        'base_amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'delivery_fees' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rentalAddress()
    {
        return $this->hasOne(RentalAddress::class);
    }

    public function rentalProducts()
    {
        return $this->hasMany(RentalProduct::class);
    }
}
