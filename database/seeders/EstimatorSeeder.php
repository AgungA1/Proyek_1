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
        $data = [
            'username' => 'estimator',
            'nama' => 'estimator',
            'email' => 'estimator1@gmail.com',
            'no_telp' => '0859632921',
            'avatar' => 'avatar.jpg',
            'password' => Hash::make('password'),
        ];

        DB::table('estimator')->insert($data);
    }
}
