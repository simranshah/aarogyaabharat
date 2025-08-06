<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_order_id',
        'product_id',
        'user_id',
        'tenure',
        'monthly_rent',
        'total_rent',
        'deposit_amount',
        'gst_amount',
        'delivery_fees',
        'total_amount',
        'start_date',
        'end_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'monthly_rent' => 'decimal:2',
        'total_rent' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'gst_amount' => 'decimal:2',
        'delivery_fees' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function rentalOrder()
    {
        return $this->belongsTo(RentalOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Admin\Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentalPayments()
    {
        return $this->hasMany(RentalPayment::class);
    }
}
