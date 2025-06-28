<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferAndDiscount extends Model
{
    use HasFactory;

    protected $table = 'offers_and_discounts';

    protected $fillable = [
        'type',
        'value',
        'code',
        'start_date',
        'end_date',
        'title',
        'description',
        'image',
        'up_to_off',
        'complete_off_on',
        'show_on_site',
        'usage_limit',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];
}
