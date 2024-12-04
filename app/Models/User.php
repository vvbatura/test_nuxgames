<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
    ];

    /**
     * @return hasMany
     */
    public function links(): hasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * @return hasMany
     */
    public function games(): hasMany
    {
        return $this->hasMany(Game::class);
    }
}
