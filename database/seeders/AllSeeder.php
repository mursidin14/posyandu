<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'email'=>'admin@id.id',
            'password'=> Hash::make('12345678'),
        ]);
        // Menginput Data Palsu Ke Database
        for($i = 0; $i <= 50; $i++)
        {
            if($i %2){
                $tempatLahir = 'sleman';
                $pendidikan = 'SMA';
                $pekerjaan = 'Swasta';
                $jenis = 'Laki-Laki';
            }
            else{
                $pendidikan = 'Sarjana';
                $tempatLahir = 'Semarang';
                $pekerjaan = 'Pegawai Negeri';
                $jenis = 'Perempuan';
            }
        Balita::create([
            'nama_balita'=>'Balita ke '.$i,
            'tpt_lahir'=>$tempatLahir,
            'tgl_lahir'=>now(),
            'nama_orangtua'=>'Orang tua ke'.$i,
            'pendidikan'=>$pendidikan,
            'pekerjaan'=>$pekerjaan,
            'alamat' => 'Indonesia',
            'jenis_kelamin'=>$jenis,
            'ket'=>'Nothing',
        ]);
        }
    }
}
