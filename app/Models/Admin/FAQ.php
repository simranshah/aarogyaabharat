<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $table = 'faqs';
    protected $fillable = [
        'question',
        'category'
    ];

    public function answers()
    {
        return $this->hasMany(FAQAnswer::class, 'faq_id');
    }
}
