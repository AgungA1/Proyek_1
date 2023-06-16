<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            EstimatorSeeder::class,
            GudangSeeder::class,
            KategoriSeeder::class,
            StafGudangSeeder::class,
            SuplierSeeder::class,
            UserSeeder::class
        ]);
    }
}
