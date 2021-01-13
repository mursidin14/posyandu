<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Penimbangan;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('blog.index',compact('jadwal'));
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
        $request->validate([
            'tanggal_kegiatan'=>'required',
            'nama_kegiatan'=>'required',
        ]);
        
        $blog = Jadwal::create($request->all());
        return redirect('/blog')->with('status','Data Jadwal Berhasil Di Tambahkan');
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
    public function edit(Jadwal $jadwal)
    {
        return view('blog.edit',compact('jadwal'));
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
            'nama_kegiatan' =>'required',
            'tanggal_kegiatan' =>'required',
            'waktu' =>'required',
        ]);
        
        Jadwal::where('id',$id)
                ->update([
                    'nama_kegiatan'=>$request->nama_kegiatan,
                    'tanggal_kegiatan'=>$request->tanggal_kegiatan,
                    'waktu'=>$request->waktu,
                    
                ]);
        return redirect('/blog')->with('status','Data Jadwal Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::destroy($id);
        return redirect('/blog')->with('status','Delete Succes');
    }
}
