<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_order_id',
        'house_number',
        'society_name',
        'locality',
        'landmark',
        'pincode',
        'city',
        'state',
        'phone',
        'alternate_phone',
        'address_type',
        'is_delivery_address'
    ];

    protected $casts = [
        'is_delivery_address' => 'boolean',
    ];

    public function rentalOrder()
    {
        return $this->belongsTo(RentalOrder::class);
    }

    public function getFullAddressAttribute()
    {
        $address = [];
        
        if ($this->house_number) {
            $address[] = $this->house_number;
        }
        
        if ($this->society_name) {
            $address[] = $this->society_name;
        }
        
        if ($this->locality) {
            $address[] = $this->locality;
        }
        
        if ($this->landmark) {
            $address[] = $this->landmark;
        }
        
        $address[] = $this->city . ', ' . $this->state;
        $address[] = 'PIN: ' . $this->pincode;
        
        return implode(', ', $address);
    }
}
