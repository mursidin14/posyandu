<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan filter bulan dan tahun dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Query untuk mendapatkan laporan
        $laporan = DB::table('balitas')
            ->leftJoin('penimbangans', 'balitas.id', '=', 'penimbangans.balita_id')
            ->leftJoin('imunisasi', 'balitas.id', '=', 'imunisasi.balita_id')
            ->select(
                'balitas.nik', 
                'balitas.nama_balita', 
                'penimbangans.bb', 
                'penimbangans.tb', 
                'penimbangans.lika', 
                'penimbangans.lila', 
                'balitas.umur', 
                'imunisasi.jenis_imun', 
                // 'penimbangans.ket'
            );

        // Filter berdasarkan bulan dan tahun jika ada
        if ($bulan && $tahun) {
            $laporan = $laporan->whereMonth('penimbangans.created_at', $bulan)
                               ->whereYear('penimbangans.created_at', $tahun);
        } elseif ($tahun) {
            $laporan = $laporan->whereYear('penimbangans.created_at', $tahun);
        }

        $laporan = $laporan->get();

        return view('laporan.index', compact('laporan', 'bulan', 'tahun'));
    }

    // function cetak pdf
    public function exportPdf(Request $request)
    {
        // Dapatkan filter bulan dan tahun dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Query untuk mendapatkan laporan
        $laporan = DB::table('balitas')
            ->leftJoin('penimbangans', 'balitas.id', '=', 'penimbangans.balita_id')
            ->leftJoin('imunisasi', 'balitas.id', '=', 'imunisasi.balita_id')
            ->select(
                'balitas.nik', 
                'balitas.nama_balita', 
                'penimbangans.bb', 
                'penimbangans.tb', 
                'penimbangans.lika', 
                'penimbangans.lila', 
                'balitas.umur', 
                'imunisasi.jenis_imun', 
                // 'penimbangans.ket'
            );

        // Filter berdasarkan bulan dan tahun jika ada
        if ($bulan && $tahun) {
            $laporan = $laporan->whereMonth('penimbangans.created_at', $bulan)
                               ->whereYear('penimbangans.created_at', $tahun);
        } elseif ($tahun) {
            $laporan = $laporan->whereYear('penimbangans.created_at', $tahun);
        }

        $laporan = $laporan->get();

        // Buat view untuk PDF
        $pdf = PDF::loadView('laporan.pdf', compact('laporan', 'bulan', 'tahun'));

        // Download PDF
        return $pdf->download('laporan_anak.pdf');
    }
}

