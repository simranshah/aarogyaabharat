<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQAnswer extends Model
{
    use HasFactory;
   
    protected $table = 'faq_answers';
    protected $fillable = ['answer', 'faq_id'];
    
    public function faq()
    {
        return $this->belongsTo(FAQ::class, 'faq_id');
    }
}
