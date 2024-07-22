<?php

namespace Database\Factories;

use App\Models\Ayah;
use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelahiranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'orang_tua_id' => OrangTua::factory(),
            'ayah_id' => Ayah::factory(),
            'balita_id' => Balita::factory(),
            'jumlah_lahiran' => $this->faker->numberBetween(1, 5),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tgl' => $this->faker->date,
            'status_ibu' => $this->faker->randomElement(['Selamat', 'Meninggal']),
            'status_bayi' => $this->faker->randomElement(['Selamat', 'Meninggal']),
        ];
    }
}
