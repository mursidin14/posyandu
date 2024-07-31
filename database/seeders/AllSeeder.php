<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AllSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        // create akun Admin
        User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'type' => 'admin'
        ]);

        // Create akun kader
        User::updateOrCreate([
            'name' => 'kader',
            'email' => 'kader@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'user'
        ]);

        
    }
}
