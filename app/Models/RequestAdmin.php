<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAdmin extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_admin';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_barang',
        'id_kategori',
        'tanggal',
        'nama_barang',
        'kuantitas_barang',
        'jenis_request',
        'status_request',
        'status_penyelesaian',
        'status_persetujuan',
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'kode_barang');
    }

    public function gudang(){
        return $this->belongsToMany(Gudang::class, 'respon_staf', 'id_request', 'id_gudang')->withPivot('persetujuan', 'kuantitas', 'persetujuan_admin');
    }

    public function response(){
        return $this->hasMany(ResponStaf::class, 'id_request');
    }
}
