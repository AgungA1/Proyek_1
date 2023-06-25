<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RequestAdmin;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        RequestAdmin::factory(20)->create();

        

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
