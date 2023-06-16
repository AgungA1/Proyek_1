<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_kategori',
        'nama_barang',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function request_admin(){
        return $this->hasMany(RequestAdmin::class, 'kode_barang');
    }

    public function barang_masuk(){
        return $this->hasMany(BarangMasuk::class, 'kode_barang');
    }

    public function barang_keluar(){
        return $this->hasMany(BarangKeluar::class, 'kode_barang');
    }

    public function gudang(){
        return $this->belongsToMany(Gudang::class, 'barang_gudang', 'kode_barang', 'id_gudang')->withPivot('kuantitas_barang');
    }
}
