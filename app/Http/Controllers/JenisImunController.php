<?php

namespace App\Http\Controllers;

use App\Models\JenisImun;
use Illuminate\Http\Request;

class JenisImunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jenisImun = JenisImun::orderBy('created_at','ASC')->paginate(10);
        return view('jenisImun.index', compact('jenisImun'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_imun' => ['required', 'max:100']
        ]);
        JenisImun::create($request->all());
        return redirect('/jenisImun')->with('status', 'Data Jenis imun Berhasil di Tambahkan');
    }

    public function show($id)
    {
        $jenisImun = JenisImun::all();
        return view('/jenisImun.detail', compact('jenisImun'));
    }

    public function eidt($id)
    {
        $jenisImun = JenisImun::findOrFail($id);
        return view('/jenisImun.eidt', compact('jenisImun'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_imun' => 'required'
        ]);
        JenisImun::query()->where('id', $id)->update([
            'name_imun' => $request->name_imun
        ]);

        return redirect('/jenisImun')->with('status', 'Data Jenis imun Berhasil di Update');
    }

    public function destroy($id)
    {
        JenisImun::destroy($id);
        return redirect('/jenisImun')->with('status', 'Data Jenis imun Berhasil Di hapus');
    }
}
