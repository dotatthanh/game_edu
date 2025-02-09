<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
