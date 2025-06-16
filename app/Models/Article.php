<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'author_email',
        'topic',
        'title',
        'abstract',
        'file_path',
        'status'
    ];

    protected $casts = [
        'topic' => 'string',
    ];
}