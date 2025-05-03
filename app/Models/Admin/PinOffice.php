<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinOffice extends Model
{
    use HasFactory;

    protected $table = 'offices'; 
 
    protected $fillable = [
        'circle_name',
        'region_name',
        'division_name',
        'office_name',
        'pin',
        'office_type',
        'delivery',
        'district',
        'state',
        'latitude',
        'longitude',
        'available',
    ];
}
