<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Estimator extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'estimator';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estimator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nama',
        'email',
        'no_telp',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_estimator',
        'remember_token',
    ];
}
