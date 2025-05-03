<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAdress extends Model
{
    use HasFactory;

    protected $table = 'customers_address';

    protected $gaurd;
}
