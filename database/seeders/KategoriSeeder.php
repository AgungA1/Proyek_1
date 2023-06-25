<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_kategori'=>'Kaca',
                'deskripsi_kategori'=>'Barang pecah belah'
            ],
            [
                'nama_kategori'=>'Lampu',
                'deskripsi_kategori'=>'Penerang ruangan'
            ],
            [
                'nama_kategori'=>'Paku',
                'deskripsi_kategori'=>'Paku besi penyambung dinding'
            ]
        ];

        DB::table('kategori')->insert($data);

    }
}
