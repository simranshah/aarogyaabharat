<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaiseQuery extends Model
{
    use HasFactory;

    protected $table = 'raise_queries';

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'mobile',
        'product_name',
        'file_upload',
        'description',
    ];
}
