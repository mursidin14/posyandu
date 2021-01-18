<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Carbon\Carbon;
use Cron\MonthField;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Str;

use App\Models\Balita;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menyiapkan data untuk chart
        /* variabel dari dan sampai diisi dengan value kosong */
        $dari = '';
        $sampai = '';
        /* Variabel keuangan diisi dengan pemanggilan atau Query data dari Database */
        /* Paginate berfungsi untuk membatasi data yang ditampilkan */
        $keuangan = Keuangan::orderBy('tanggal','asc')->paginate(10);
        /* variabel $masuk diisi dengan sum dari kolom pemasukan atau menghitung jumlah total pada kolom pemasukan */
        $masuk = $keuangan->sum('pemasukan');
        /* variabel $keluar diisi dengan sum dari kolom pengeluaran atau menghitung jumlah total pada kolom pengeluaran */
        $keluar = $keuangan->sum('pengeluaran');
          /* variabel saldo diisi dengan operasi pengurangan dari pemasukan dikurangi pengeluaran sehingga dihasilkan saldo  */
        $saldo = $masuk -$keluar;
         /* Return view berungsi untuk mengembalikan tampilan ke folder keuangan kemudian file index 
            compact berfungsi untuk membawa data dari Kontroller menuju ke tampilan
         */
        return view('keuangan.index',compact('keuangan','masuk','keluar','saldo','dari','sampai'));
    }
    public function periode(Request $request){
        $filterTanggal = Keuangan::all();
        $dari = $request->dari;
        $sampai = $request->sampai;
        // $keuangan = Keuangan::paginate(10);
        $keuangan =Keuangan::whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->orderBy('tanggal','asc')->paginate(10);
        $masuk = $keuangan->sum('pemasukan');
        $keluar = $keuangan->sum('pengeluaran');
        $saldo = $masuk -$keluar;


        
        return view('keuangan.index',compact('keuangan','masuk','keluar','saldo','filterTanggal','dari','sampai'));
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
            'tanggal'=>'required',
            'deskripsi'=>'required',
        ]);
        if($request->pemasukan == !null){
            Keuangan::create([
                'tanggal'=>$request->tanggal,
                'pemasukan'=>$request->pemasukan,
                'pengeluaran'=>0,
                'deskripsi'=>$request->deskripsi,
                'jenis'=>$request->jenis,
            ]);
            return redirect('/kasmasuk')->with('status','Data Kas Masuk berhasil ditambahkan!');
        }
        else{
            Keuangan::create([
                'tanggal'=>$request->tanggal,
                'pemasukan'=>0,
                'pengeluaran'=>$request->pengeluaran,
                'deskripsi'=>$request->deskripsi,
                'jenis'=>$request->jenis,
                ]);
                return redirect('/kaskeluar')->with('status','Data Kas Keluar berhasil ditambahkan!');
        }
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
    public function edit(Keuangan $keuangan)
    {
        return view('keuangan.edit',compact('keuangan'));
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
            'deskripsi'=>'required',
        ]);
        
        Keuangan::where('id',$id)
                ->update([
                    'pemasukan'=>$request->pemasukan,
                    'jenis'=>$request->jenis,
                    'tanggal'=>$request->tanggal,
                    'pengeluaran'=>$request->pengeluaran,
                    'deskripsi'=>$request->deskripsi,
                ]);
        return redirect('/keuangan')->with('status','Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Keuangan::destroy($id);
        return redirect('/keuangan')->with('status','Data berhasil dihapus!');
    }

    public function kasmasuk(){
        $dari = '';
        $sampai = '';
        $masuk = Keuangan::where('pemasukan','!=' , 0)->orderBy('tanggal','ASC')->paginate(5);
        $jumlah = Keuangan::sum('pemasukan');
        return view('keuangan.kasmasuk',compact('masuk','jumlah','dari','sampai'));
    }
    public function periodeKasMasuk(Request $request){
        $dari = $request->dari;
        $sampai = $request->sampai;
        $masuk =Keuangan::whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->where('pemasukan','!=' , 0)->orderBy('tanggal','ASC')->paginate(10);
        $jumlah = $masuk->sum('pemasukan');
        return view('keuangan.kasmasuk',compact('jumlah','masuk','dari','sampai'));
    }
    public function periodeKasKeluar(Request $request){
        $dari = $request->dari;
        $sampai = $request->sampai;
        $keluar =Keuangan::whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->where('pengeluaran','!=' , 0)->orderBy('tanggal','ASC')->paginate(10);
        $jumlah = $keluar->sum('pengeluaran');
        return view('keuangan.kaskeluar',compact('jumlah','keluar','dari','sampai'));
    }
    public function kaskeluar(){
        $dari = '';
        $sampai = '';
        $keluar = Keuangan::where('pengeluaran','!=' , 0)->orderBy('tanggal','ASC')->paginate(5);
        $jumlah = Keuangan::sum('pengeluaran');
        return view('keuangan.kaskeluar',compact('keluar','jumlah','dari','sampai'));
    }
    public function pdfMasuk(Request $request){
        $dari = $request->dari;
        $sampai = $request->sampai;
        $masuk = Keuangan::whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->where('pemasukan','!=' , 0)->orderBy('tanggal','ASC')->paginate(100);
        $jumlah = $masuk->sum('pemasukan');
        $pdf = PDF::loadview('keuangan.cetakpdf.cetakpdfmasuk',compact('jumlah','masuk','dari','sampai'));
        return $pdf->download($dari.'_'.$sampai.'_laporan_kas_masuk.pdf'); 
    }
    public function pdfKeluar(Request $request){
        $dari = $request->dari;
        $sampai = $request->sampai;
        $keluar = Keuangan::whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->where('pengeluaran','!=' , 0)->orderBy('tanggal','ASC')->paginate(100);
        $jumlah = $keluar->sum('pengeluaran');
        $pdf = PDF::loadview('keuangan.cetakpdf.cetakpdfkeluar',compact('jumlah','keluar','dari','sampai'));
        return $pdf->download($dari.'_'.$sampai.'_laporan_kas_keluar.pdf'); 
    }
    public function pdfRekap(Request $request){
        $dari = $request->dari;
        $sampai = $request->sampai;
        $total = Keuangan::whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->orderBy('tanggal','ASC')->paginate(100);
        $masuk = $total->sum('pemasukan');
        $keluar = $total->sum('pengeluaran');
        $saldo = $masuk -$keluar;
        $pdf = PDF::loadview('keuangan.cetakpdf.cetakpdf',compact('total','masuk','keluar','saldo','dari','sampai'))->setPaper('a4', 'landscape');
        return $pdf->download($dari.'_'.$sampai.'_laporan_rekapitulasi.pdf'); 
    }
    public function cetakRekap(){
        $rekap = Keuangan::paginate(100);
        $masuk = $rekap->sum('pemasukan');
        $keluar = $rekap->sum('pengeluaran');
        $saldo = $masuk -$keluar;
        $pdf = PDF::loadview('keuangan.cetakpdf.cetakrekap',compact('rekap','masuk','keluar','saldo'))->setPaper('a4', 'landscape');
        return $pdf->download('All_laporan_rekapitulasi.pdf'); 
    }
}


