<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $laporan = DB::table('balitas')
            ->leftJoin('penimbangans', 'balitas.id', '=', 'penimbangans.balita_id')
            ->leftJoin('imunisasi', 'balitas.id', '=', 'imunisasi.balita_id')
            ->leftJoin('jenis_imuns', function($join) {
                $join->on('imunisasi.jenis_imun', '=', 'jenis_imuns.id');
            })
            ->select(
                'balitas.nik', 
                'balitas.nama_balita',
                'balitas.jenis_kelamin', 
                'penimbangans.bb', 
                'penimbangans.tb', 
                'penimbangans.lika', 
                'penimbangans.lila', 
                'balitas.umur', 
                'jenis_imuns.name_imun as jenis_imun',
                'balitas.alamat'
            );

        // Filter berdasarkan bulan dan tahun jika ada
        if ($this->bulan && $this->tahun) {
            $laporan = $laporan->whereMonth('penimbangans.created_at', $this->bulan)
                               ->whereYear('penimbangans.created_at', $this->tahun);
        } elseif ($this->tahun) {
            $laporan = $laporan->whereYear('penimbangans.created_at', $this->tahun);
        }

        return view('laporan.excel', [
            'laporan' => $laporan->get(),
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }
}
