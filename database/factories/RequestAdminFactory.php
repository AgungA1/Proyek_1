<?php

namespace Database\Factories;

use App\Models\RequestAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestAdmin>
 */
class RequestAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = RequestAdmin::class;

    public function definition()
    {
        return [
            'kode_barang' => fake()->randomElement([1, 2, 3]),
            'kuantitas_barang' => fake()->randomDigitNot(0),
            'tanggal' => fake()->date(),
            'jenis_request' => fake()->randomElement(['Barang Masuk', 'Barang Keluar']),
            'status_request' => 'pending',
            'status_penyelesaian' => 'pending',
            'status_persetujuan' => 'pending',
        ];
    }
}
