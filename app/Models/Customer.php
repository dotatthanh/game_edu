<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guard_name = 'web';

    protected $guard = 'web';

    protected $fillable = [
        'avatar',
        'email',
        'password',
        'name',
        'username',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function checkFavorite($game_id)
    {
        return $this->favorites()->where('game_id', $game_id)->exists();
    }
}
