<?php

namespace App\Http\Controllers;

use App\Models\Ayah;
use Illuminate\Http\Request;

class AyahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan View Index
    public function index()
    {
        $ayah = Ayah::orderBy('created_at','ASC')->paginate(10);
        return view('ayah.index', compact('ayah'));
    }

      //Menampilkan View Create
      public function create() 
      {
          $ayah = Ayah::all();
          return view('ayah.create',compact('ayah'));
      }
  
   
      //Melakukan Eksekusi Penyimpanan Ke Database
      public function store(Request $request)
      {
            $request->validate([
                'nama'=>'required',
                'alamat'=>'required',
                // 'ket'=>'required',
            ]);
            Ayah::create($request->all());
            return redirect('/ayah')->with('status','Data ayah berhasil ditambahkan!');
      }
  
      
      public function show($id)
      {
          //
      }
  
  
      public function edit($id)
      {   
          $ayah = Ayah::findOrFail($id);
          return view('ayah.edit',compact('ayah'));
      }
  
   
      public function update(Request $request, $id)
      {
          $request->validate([
              'nama'=>'required',
              'alamat'=>'required',
            //   'ket'=>'required',
          ]);
          Ayah::where('id',$id)
                  ->update([
                      'nama'=>$request->nama,
                      'alamat'=>$request->alamat,
                    //   'ket'=>$request->ket,
                  ]);
          return redirect('/ayah')->with('status','Data ayah berhasil diupdate!');
      }
  
  
      public function destroy($id)
      {
            Ayah::destroy($id);
            return redirect('/ayah')->with('status','Data ayah berhasil dihapus!');
      }
}
