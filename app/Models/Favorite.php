<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'customer_id',
        'game_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
