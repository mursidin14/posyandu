<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
   
    //Menampilkan View Index
    public function index()
    {
        $balita = Balita::orderBy('created_at','ASC')->with('orangtua')->paginate(10);
        return view('balita.index', compact('balita'));
    }

  
    //Menampilkan View Create 
    public function create()
    {
        $orangTua = OrangTua::all();
        return view('balita.create',compact('orangTua'));
    }

 
    //Melakukan Eksekusi Penyimpanan Ke Database
    public function store(Request $request)
    {
        $request->validate([
            'nama_balita'=>'required',
            'nik'=>'required',
            'tpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'umur'=>'required',
            'orang_tua_id'=>'required',
            'alamat'=>'required',
            'rt_rw'=>'required',
            'ket'=>'required',
        ]);
        Balita::create($request->all());
        return redirect('/balita')->with('status','Data Balita berhasil ditambahkan!');

    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {   
        $balita = Balita::findOrFail($id);
        $orangTua = OrangTua::all();
        return view('balita.edit',compact('orangTua','balita'));
    }

 
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_balita'=>'required',
            'nik'=>'required',
            'tpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'umur'=>'required',
            'orang_tua_id'=>'required',
            'alamat'=>'required',
            'rt_rw'=>'required',
            'ket'=>'required',
        ]);
        Balita::where('id',$id)
                ->update([
                    'nama_balita'=>$request->nama_balita,
                    'nik'=>$request->nik,
                    'tpt_lahir'=>$request->tpt_lahir,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'orang_tua_id'=>$request->orang_tua_id,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'umur'=>$request->umur,
                    'alamat'=>$request->alamat,
                    'rt_rw'=>$request->rt_rw,
                    'ket'=>$request->ket,
                ]);
        return redirect('/balita')->with('status','Data Balita berhasil diupdate!');
    }


    public function destroy($id)
    {
        Balita::destroy($id);
        return redirect('/balita')->with('status','Data Balita berhasil dihapus!');
    }
}
