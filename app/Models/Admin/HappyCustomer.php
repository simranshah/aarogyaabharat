<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HappyCustomer extends Model
{
    use HasFactory;

    // Specify which attributes can be mass assigned
    protected $fillable = [
        'name',
        'comment',
        'rate',
        'city',
        'state',
    ];
}
