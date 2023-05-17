<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang_keluar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_gudang',
        'kode_barang',
        'kuantitas_barang',
    ];
    
    public function barang(){
        return $this->belongsTo(Barang::class, 'kode_barang');
    }

    public function gudang(){
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
