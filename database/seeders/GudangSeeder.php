<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GudangSeeder extends Seeder
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
                'nama_gudang'=>'Gudang 1',
                'lokasi_gudang'=>'Jalan Sukarno No. 12 Malang'
            ],
            [
                'nama_gudang'=>'Gudang 2',
                'lokasi_gudang'=>'Jalan Firman No. 1 Malang'
            ],
            [
                'nama_gudang'=>'Gudang 3',
                'lokasi_gudang'=>'Jalan Rumani No. 22 Malang'
            ],
        ];

        DB::table('gudang')->insert($data);
    }
}
