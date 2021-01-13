<?php

namespace Database\Seeders;

use App\Models\Balita;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menginput Data Palsu Ke Database
        for($i = 0; $i <= 50; $i++)
        {
            if($i %2){
                $tempatLahir = 'sleman';
                $pendidikan = 'SMA';
                $pekerjaan = 'Swasta';
            }
            else{
                $pendidikan = 'Sarjana';
                $tempatLahir = 'Semarang';
                $pekerjaan = 'Pegawai Negeri';
            }
        Balita::create([
            'nama_balita'=>'Balita ke '.$i,
            'tpt_lahir'=>$tempatLahir,
            'tgl_lahir'=>now(),
            'nama_orangtua'=>'Orang tua ke'.$i,
            'pendidikan'=>$pendidikan,
            'pekerjaan'=>$pekerjaan,
            'alamat' => 'Indonesia',
            'ket'=>'Nothing',
        ]);
        }
    }
}
