<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
      
        // Dapatkan filter bulan dan tahun dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $search = $request->input('search');

        // Query untuk mendapatkan laporan
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
                'balitas.alamat',
                // 'penimbangans.ket'
            );

        // Filter berdasarkan bulan dan tahun jika ada
        if ($bulan && $tahun) {
            $laporan = $laporan->whereMonth('penimbangans.created_at', $bulan)
                               ->whereYear('penimbangans.created_at', $tahun);
        } elseif ($tahun) {
            $laporan = $laporan->whereYear('penimbangans.created_at', $tahun);
        }

        if($search) {
            $laporan->where(function($i) use ($search) {
                $i->where('balitas.nik', 'like', "%{$search}%")
                  ->orWhere('balitas.nama_balita', 'like', "%{$search}%");
            });
        }

        $laporan = $laporan->paginate(10);

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
                'balitas.alamat',
                // 'penimbangans.ket'
            );

        // Filter berdasarkan bulan dan tahun jika ada
        if ($bulan && $tahun) {
            $laporan = $laporan->whereMonth('penimbangans.created_at', $bulan)
                               ->whereYear('penimbangans.created_at', $tahun);
        } elseif ($tahun) {
            $laporan = $laporan->whereYear('penimbangans.created_at', $tahun);
        }

        $laporan = $laporan->paginate(10);

        // Buat view untuk PDF
        $pdf = PDF::loadView('laporan.pdf', compact('laporan', 'bulan', 'tahun'));
        return $pdf->stream('laporan.pdf');
        // Download PDF
        // return $pdf->download('laporan_anak.pdf');
    }
}

