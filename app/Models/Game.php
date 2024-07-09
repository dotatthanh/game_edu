<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'type_id',
        'class_id',
        'name',
        'image',
        'description',
        'link',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
