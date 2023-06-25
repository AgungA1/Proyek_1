<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponStaf extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'respon_staf';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_gudang',
        'id_request',
        'persetujuan',
        'kuantitas',
    ];

    public function gudang(){
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
