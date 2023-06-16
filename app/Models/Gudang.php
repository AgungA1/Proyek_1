<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gudang';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_gudang',
        'lokasi_gudang',
    ];

    public function staf_gudang(){
        return $this->hasMany(StafGudang::class, 'id_gudang');
    }

    public function barang(){
        return $this->belongsToMany(Barang::class, 'barang_gudang', 'kode_barang', 'id_gudang');
    }

    public function barang_masuk(){
        return $this->hasMany(BarangMasuk::class, 'id_gudang');
    }

    public function barang_keluar(){
        return $this->hasMany(BarangKeluar::class, 'id_gudang');
    }
}
