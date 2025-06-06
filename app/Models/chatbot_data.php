<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chatbot_data extends Model
{
    
    protected $table = 'chatbot_data';
    protected $fillable = [
        'input',
        'response',
    ];
}
