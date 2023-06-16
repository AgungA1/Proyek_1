<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StafGudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'id_gudang' => 2,
                'username' => 'cakpri',
                'nama' => 'staf 2',
                'email' => 'staf2@staf.com',
                'no_telp' => '087777777',
                'avatar' => 'default.png',
                'password' => Hash::make('password'),
            ]
        ];

        DB::table('staf_gudang')->insert($data);
    }
}
