<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Customer;
use App\Models\Admin\product;

class reviews extends Model
{
    use HasFactory;
    protected $table = 'product_reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'review', // <-- Add this line
    ];
    public function Customer()
    {
        return $this->belongsTo(Customer::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(product::class,'product_id');
    }

}
