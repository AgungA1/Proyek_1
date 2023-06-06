<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StafGudang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'staf_gudang';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'staf_gudang';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username_staf',
        'nama_staf',
        'email_staf',
        'no_telp_staf',
        'avatar_staf',
        'password_staf',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_staf',
        'remember_token',
    ];

    public function gudang(){
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
