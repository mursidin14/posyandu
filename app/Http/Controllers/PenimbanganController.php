<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Balita;
use App\Models\Jadwal;
use App\Models\Penimbangan;

use Illuminate\Http\Request;

class PenimbanganController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dari = '';
        $sampai = '';
        $balita = Balita::all();
        $timbangan = Penimbangan::with('balita','user')->orderBy('tanggal_timbang', 'DESC')->paginate(10);
        $chart = [];
        $tinggiBadan = [];
        $beratBadan = [];
        foreach($timbangan as $mp){
            $chart[]= $mp->balita->nama_balita;
            $beratBadan[]= $mp->bb;
            $tinggiBadan[]= $mp->tb;
        }

        $jenisKelaminLaki = Balita::where('jenis_kelamin','Laki-laki')->get();
        $laki[] = count($jenisKelaminLaki);
        
        $jenisKelaminPerem = Balita::where('jenis_kelamin','Perempuan')->get();
        $perem[] = count($jenisKelaminPerem);
        $tanggalPelayanan = Jadwal::all();
    
        return view('timbangan.index',compact(
            'timbangan',
            'balita',
            'chart',
            'tinggiBadan',
            'beratBadan',
            'laki',
            'perem',
            'tanggalPelayanan',
            'dari',
            'sampai'
        ));
    }

    public function periodeTimbang(Request $request){

        $balita = Balita::all();
        $filterTanggal = Penimbangan::all();
        $dari = $request->dari;
        $sampai = $request->sampai;
        // $keuangan = Keuangan::paginate(10);
        $timbangan =Penimbangan::with('balita','user')->whereDate('tanggal_timbang','>=',$dari)->whereDate('tanggal_timbang','<=',$sampai)->orderBy('tanggal_timbang','desc')->paginate(10);
        $tanggalPelayanan = Jadwal::all();
        $chart = [];
        $tinggiBadan = [];
        $beratBadan = [];
        foreach($timbangan as $mp){
            $chart[]= $mp->balita->nama_balita;
            $beratBadan[]= $mp->bb;
            $tinggiBadan[]= $mp->tb;
        }

        $jenisKelaminLaki = Balita::where('jenis_kelamin','Laki-laki')->get();
        $laki[] = count($jenisKelaminLaki);
        
        $jenisKelaminPerem = Balita::where('jenis_kelamin','Perempuan')->get();
        $perem[] = count($jenisKelaminPerem);
        $tanggalPelayanan = Jadwal::all();
        return view('timbangan.index',compact(
            'timbangan',
            'balita',
            'chart',
            'tinggiBadan',
            'beratBadan',
            'laki',
            'perem',
            'tanggalPelayanan',
            'dari',
            'sampai'
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
            'balita_id'=>'required',
            'bb'=>'required',
            'tb'=>'required',
            'user_id'=>'required'
        ]);
        Penimbangan::create($request->all());
        return redirect('/penimbangan')->with('status','Data Penimbangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penimbangan = Penimbangan::with('balita')->where('id',$id)->get();
        $chart = [];
        $tinggiBadan = [];
        $beratBadan = [];
        $tanggal =[];
        foreach($penimbangan as $mp){
            $chart[]= $mp->balita->nama_balita;
            $beratBadan[]= $mp->bb;
            $tinggiBadan[]= $mp->tb;
        }
        return view('timbangan.detail',compact('penimbangan','chart','beratBadan','tinggiBadan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penimbangan $penimbangan)
    {
        $balita = Balita::all();
        return view('timbangan.edit',compact('penimbangan','balita'));
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
            'balita_id'=>'required',
            'bb'=>'required',
            'tb'=>'required',
        ]);
        Penimbangan::where('id',$id)
        ->update([
            'balita_id'=>$request->balita_id,
            'bb'=>$request->bb,
            'tb'=>$request->tb,
        ]);
        return redirect('/penimbangan')->with('status','Data Penimbangan berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penimbangan::destroy($id);
        return redirect('/penimbangan')->with('status','Data Penimbangan berhasil dihapus!');
    }
}
