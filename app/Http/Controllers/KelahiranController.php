<?php

namespace App\Http\Controllers;

use App\Models\Ayah;
use App\Models\Balita;
use App\Models\Kelahiran;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class KelahiranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    //Menampilkan View Index
    public function index()
    {
        $kelahiran = Kelahiran::orderBy('created_at','ASC')->with(['orangtua', 'ayah', 'balita'])->paginate(10);
        return view('kelahiran.index', compact('kelahiran'));
    }

  
    //Menampilkan View Create 
    public function create()
    {
        $orangTua = OrangTua::all();
        $ayah = Ayah::all();
        $balita = Balita::all();
        return view('kelahiran.create',compact('orangTua', 'ayah', 'balita'));
    }

 
    //Melakukan Eksekusi Penyimpanan Ke Database
    public function store(Request $request)
    {
        $request->validate([
            'orang_tua_id'=>'required',
            'ayah_id'=>'required',
            'balita_id'=>'required',
            'jumlah_lahiran'=>'required',
            'jenis_kelamin'=>'required',
            'tgl'=>'required',
            'status_ibu'=>'required',
            'status_bayi'=>'required',
        ]);
        Kelahiran::create($request->all());
        return redirect('/kelahiran')->with('status','Data Kelahiran berhasil ditambahkan!');

    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {   
        $kelahiran = Kelahiran::findOrFail($id);
        $orangTua = OrangTua::all();
        $ayah = Ayah::all();
        $balita = Balita::all();
        return view('kelahiran.edit',compact('orangTua', 'ayah', 'balita', 'kelahiran'));
    }

 
    public function update(Request $request, $id)
    {
        $request->validate([
            'orang_tua_id'=>'required',
            'ayah_id'=>'required',
            'balita_id'=>'required',
            'jumlah_lahiran'=>'required',
            'jenis_kelamin'=>'required',
            'tgl'=>'required',
            'status_ibu'=>'required',
            'status_bayi'=>'required',
        ]);
        Kelahiran::where('id',$id)
                ->update([
                    'orang_tua_id'=>$request->orang_tua_id,
                    'ayah_id'=>$request->ayah_id,
                    'balita_id'=>$request->balita_id,
                    'jumlah_lahiran'=>$request->jumlah_lahiran,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'tgl'=>$request->tgl,
                    'status_ibu'=>$request->status_ibu,
                    'status_bayi'=>$request->status_bayi,
                ]);
        return redirect('/kelahiran')->with('status','Data Kelahiran berhasil diupdate!');
    }


    public function destroy($id)
    {
        Kelahiran::destroy($id);
        return redirect('/kelahiran')->with('status','Data kelahiran berhasil dihapus!');
    }
}
