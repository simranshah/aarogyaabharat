<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\Admin\Status;

class RetrunItems extends Model
{
    use HasFactory;
    protected $table = 'return_item';
    protected $fillable = [
        'order_id',
        'order_item_id',
        'qty',
        'price',
        'status_id',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
     public function orderItems() // Change from products to product
    {
        return $this->belongsTo(OrderItem::class,'order_item_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
