<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Imunisasi;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class ImunisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggal_imun = [];
        $balita = Balita::all();
        $imunisasi = Imunisasi::with('balita')->orderBy('tanggal_imun', 'DESC')->paginate(10);
        $umur = [];
        $jenis_imun = [];
        $tanggalPelayanan = Jadwal::all();
    
        return view('imunisasi.index',compact(
            'tanggalPelayanan',
            'imunisasi',
            'balita',
            'tanggal_imun',
            'umur',
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
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_imun' => 'required',
            'balita_id'=>'required',
            'umur'=>'required',
            'jenis_imun'=>'required',
        ]);
        Imunisasi::create($request->all());
        return redirect('/imunisasi')->with('status','Data Imun berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tanggal_imun = [];
        $imunisasi = Imunisasi::with('balita')->where('id',$id)->get();
        $umur = [];
        $jenis_imun = [];
 
        return view('imunisasi.detail',compact('tanggal_imun','umur','jenis_imun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imunisasi = Imunisasi::findOrFail($id);
        $balita = Balita::all();
        return view('imunisasi.edit',compact('imunisasi','balita'));
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
        $request->validate([
            'tanggal_imun'=>'required',
            'balita_id'=>'required',
            'umur'=>'required',
            'jenis_imun'=>'required',
        ]);
        Imunisasi::where('id',$id)
        ->update([
            'tanggal_imun'=>$request->tanggal_imun,
            'balita_id'=>$request->balita_id,
            'umur'=>$request->umur,
            'jenis_imun'=>$request->jenis_imun,
        ]);
        return redirect('/imunisasi')->with('status','Data Imun berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Imunisasi::destroy($id);
        return redirect('/imunisasi')->with('status','Data Imun berhasil dihapus!');
    }
}
