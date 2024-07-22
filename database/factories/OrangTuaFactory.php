<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrangTuaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'alamat' => $this->faker->address,
        ];
    }
}
