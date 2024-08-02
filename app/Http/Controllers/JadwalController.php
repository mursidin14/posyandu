<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Gallery;
use App\Models\Jadwal;
use App\Models\JenisImun;
use App\Models\Penimbangan;
use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\User;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::orderBy('tanggal_kegiatan','ASC')->get();
        $balita = Balita::all();
        $jenis_imun = JenisImun::all();
        $countBalita = count($balita);
        $kader = User::all();
        $countKader = count($kader);
        $tinggiBadan = [];
        $beratBadan = [];
        $laporan = DB::table('balitas')
        ->leftJoin('penimbangans', 'balitas.id', '=', 'penimbangans.balita_id')
        ->leftJoin('orang_tuas', 'balitas.orang_tua_id', '=', 'orang_tuas.id')
        ->select(
            'balitas.nama_balita',
            'orang_tuas.nama', 
            'penimbangans.bb', 
            'penimbangans.tb', 
            'penimbangans.lika', 
            'penimbangans.lila', 
            'penimbangans.catatan',
        )->get();


        $gallery = Gallery::all();

        return view('welcome',compact('jadwal',
            'countKader',
            'countBalita',
            'laporan',
            'tinggiBadan',
            'beratBadan',
            'gallery',
            'balita',
            'jenis_imun',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
