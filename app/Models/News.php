<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    const NEWS = 1;
    const NEWS_STUDY = 2;

    protected $fillable = [
        'title',
        'image',
        'summary',
        'content',
        'type',
    ];
}
