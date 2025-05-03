<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;
    protected $table = 'order_address';

    protected $fillable = [
        'order_id',
        'house_number',
        'society_name',
        'locality',
        'landmark',
        'pincode',
        'city',
        'state',
    ];

}
