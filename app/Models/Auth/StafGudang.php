<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class StafGudang extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'staf_gudang';
}
