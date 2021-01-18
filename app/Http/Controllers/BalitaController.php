<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balita = Balita::orderBy('created_at','ASC')->paginate(10);
        return view('balita.index', compact('balita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('balita.create');
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
            'nama_balita'=>'required',
            'tpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'nama_orangtua'=>'required',
            'pendidikan'=>'required',
            'pekerjaan'=>'required',
            'alamat'=>'required',
            'ket'=>'required',
        ]);
        Balita::create($request->all());
        return redirect('/balita')->with('status','Data Balita berhasil ditambahkan!');

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
        $balita = Balita::findOrFail($id);
        return view('balita.edit',compact('balita'));
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
            'nama_balita'=>'required',
            'tpt_lahir'=>'required',
            'tgl_lahir'=>'required',
            'nama_orangtua'=>'required',
            'pendidikan'=>'required',
            'pekerjaan'=>'required',
            'alamat'=>'required',
            'ket'=>'required',
        ]);
        Balita::where('id',$id)
                ->update([
                    'nama_balita'=>$request->nama_balita,
                    'tpt_lahir'=>$request->tpt_lahir,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'nama_orangtua'=>$request->nama_orangtua,
                    'pendidikan'=>$request->pendidikan,
                    'pekerjaan'=>$request->pekerjaan,
                    'alamat'=>$request->alamat,
                    'ket'=>$request->ket,
                ]);
        return redirect('/balita')->with('status','Data Balita berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Balita::destroy($id);
        return redirect('/balita')->with('status','Data Balita berhasil dihapus!');
    }
}
