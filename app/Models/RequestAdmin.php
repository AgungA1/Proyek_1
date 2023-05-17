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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kuantitas_barang',
        'jenis_request',
        'status_request',
        'status_penyelesaian',
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'kode_barang');
    }
}
