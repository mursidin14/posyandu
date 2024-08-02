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
        return view('jenis_imun.index', compact('jenisImun'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_imun' => ['required', 'max:100'],
            'usia_pakai' => ['required', 'max:100']
        ]);
        JenisImun::create($request->all());
        return redirect('/jenisimun')->with('status', 'Data Jenis imun Berhasil di Tambahkan');
    }

    public function show($id)
    {
        $jenisImun = JenisImun::all();
        return view('/jenis_imun.detail', compact('jenisImun'));
    }

    public function edit($id)
    {
        $jenisImun = JenisImun::findOrFail($id);
        return view('/jenis_imun.edit', compact('jenisImun'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_imun' => 'required',
            'usia_pakai' => 'required'
        ]);
        JenisImun::query()->where('id', $id)->update([
            'name_imun' => $request->name_imun,
            'usia_pakai' => $request->usia_pakai
        ]);

        return redirect('/jenisimun')->with('status', 'Data Jenis imun Berhasil di Update');
    }

    public function destroy($id)
    {
        JenisImun::destroy($id);
        return redirect('/jenisimun')->with('status', 'Data Jenis imun Berhasil Di hapus');
    }
}
