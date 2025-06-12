<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Status;
use App\Models\Admin\OrderItem;

class orderCancelItem extends Model
{
    use HasFactory;
     protected $table = 'cancel_order_item';
     protected $fillable = [
        'order_id',
        'order_item_id',
        'qty',
        'price',
        'status_id',
    ];
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function orderItems() // Change from products to product
    {
        return $this->belongsTo(OrderItem::class,'order_item_id');
    }

}
