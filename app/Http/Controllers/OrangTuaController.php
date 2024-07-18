<?php

namespace App\Http\Controllers;


use App\Models\Keuangan;
use App\Models\OrangTua;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan View Index
    public function index()
    {
        $orangTua = OrangTua::orderBy('created_at','ASC')->paginate(10);
        return view('orang_tua.index', compact('orangTua'));
    }

      //Menampilkan View Create
      public function create() 
      {
          $orangTua = OrangTua::all();
          return view('orang_tua.create',compact('orangTua'));
      }
  
   
      //Melakukan Eksekusi Penyimpanan Ke Database
      public function store(Request $request)
      {
            $request->validate([
                'nama'=>'required',
                'alamat'=>'required',
                // 'ket'=>'required',
            ]);
            OrangTua::create($request->all());
            return redirect('/orangtua')->with('status','Data Orang Tua berhasil ditambahkan!');
      }
  
      
      public function show($id)
      {
          //
      }
  
  
      public function edit($id)
      {   
          $orangTua = OrangTua::findOrFail($id);
          return view('orang_tua.edit',compact('orangTua'));
      }
  
   
      public function update(Request $request, $id)
      {
          $request->validate([
              'nama'=>'required',
              'alamat'=>'required',
            //   'ket'=>'required',
          ]);
          OrangTua::where('id',$id)
                  ->update([
                      'nama'=>$request->nama,
                      'alamat'=>$request->alamat,
                    //   'ket'=>$request->ket,
                  ]);
          return redirect('/orangtua')->with('status','Data Orang Tua berhasil diupdate!');
      }
  
  
      public function destroy($id)
      {
            OrangTua::destroy($id);
            return redirect('/orangtua')->with('status','Data Orang Tua berhasil dihapus!');
      }
}