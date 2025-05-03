<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    // Define which attributes are mass-assignable
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'status',
        'display_order',
        'is_mobile'
    ];
}
