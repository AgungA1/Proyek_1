<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StafGudang extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'staf_gudang';

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
