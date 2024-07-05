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

    protected $table = 'users';

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function post(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }
}
