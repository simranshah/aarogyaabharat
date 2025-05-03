<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Front\Cart;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'offer_id',
        'amount',
        'customer_id',
        'status_id',
        'payment_response',
        'razorpay_order_id',
        'gst',
        'razorpay_payment_id',
        'razorpay_signature'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); 
    }

    public function orderAddress()
    {
        return $this->hasOne(OrderAddress::class); 
    }
    public function orderOffer()
    {
        return $this->belongsTo(OfferAndDiscount::class, 'offer_id'); 
    }
}
