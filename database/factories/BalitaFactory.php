<?php

namespace Database\Factories;

use App\Models\Ayah;
use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_balita' => $this->faker->name,
            'nik' => $this->faker->unique()->numerify('##########'),
            'tpt_lahir' => $this->faker->city,
            'tgl_lahir' => $this->faker->date,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'umur' => $this->faker->numberBetween(1, 5),
            'orang_tua_id' => OrangTua::factory(),
            'alamat' => $this->faker->address,
            'rt_rw' => $this->faker->bothify('##/##'),
            'ket' => $this->faker->sentence,
            'ayah_id' => Ayah::factory(),
        ];
    }
}
