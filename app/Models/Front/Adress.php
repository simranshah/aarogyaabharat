<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Adress extends Model
{
    use HasFactory;

    protected $table = 'customers_address';

    protected $fillable = [
        'customer_id',
        'house_number',
        'society_name',
        'locality',
        'landmark',
        'pincode',
        'city',
        'state',
        'is_delivery_address',
        'mobile',
        'name',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id'); // Using 'customer_id' as the foreign key
    }

}
