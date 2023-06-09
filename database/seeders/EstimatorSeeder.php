<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EstimatorSeeder extends Seeder
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
                'username' => 'admin',
                'nama' => 'admin',
                'email' => 'admin2@admin.com',
                'no_telp' => '087777777',
                'password' => Hash::make('password'),
            ]
        ];

        DB::table('admin')->insert($data);
    }
}
