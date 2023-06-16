<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuplierSeeder extends Seeder
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
                'nama_supplier' => 'PT. Yumantara Lima',
                'alamat_supplier' => 'Jln Firmansyah No. 25 Jakarta',
                'no_telp_supplier' => '086958493'
            ],
            [
                'nama_supplier' => 'CV. Matahari Hitam',
                'alamat_supplier' => 'Jln Gilas No. 11 Bandung',
                'no_telp_supplier' => '089567483'
            ],
            [
                'nama_supplier' => 'PT. Yuan Tiang',
                'alamat_supplier' => 'Jln Suharto No. 3 Blitar',
                'no_telp_supplier' => '084892733'
            ],
            [
                'nama_supplier' => 'CV. Kesamben Jaya',
                'alamat_supplier' => 'Jln Riansyah No. 22 Blitar',
                'no_telp_supplier' => '086958493'
            ],
            [
                'nama_supplier' => 'Pak Angling',
                'alamat_supplier' => 'Jln Gemilang No. 11 Malang',
                'no_telp_supplier' => '0848292'
            ]

        ];

        DB::table('supplier')->insert($data);
    }
}
