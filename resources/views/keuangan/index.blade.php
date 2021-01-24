@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Keuangan</li>
      <li class="breadcrumb-item active" aria-current="page">Rekapitulasi</li>
    </ol>
</nav>
<div class="">
    @if (session('status'))
        <div class="alert alert-success">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif
</div>
<div class="">
    <div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
    <div class="row mb-3" >
        <div class="col">
            <form action="{{url('/filter/periode')}}" method="get">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                        <input class="form-control dateselect" type="text" name="dari" id="" autocomplete="off" value="{{$dari}}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input class="form-control dateselect" type="text" name="sampai" id="" autocomplete="off"value="{{$sampai}}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary" ><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col">
            @php
                if($dari  == null){
                    echo'<style>.dari{display:none;}</style>';
                }
            @endphp
            <form action="{{url('/filter/cetakpdfrekap')}}" method="get" >
                <input type="text" name="dari" style="display: none" value="{{$dari}}">
                <input type="text" name="sampai" style="display: none" value="{{$sampai}}">
                <div class="dari">
                    <button type="submit" style="display: block;" class="btn btn-outline-dark" ><i class="fas fa-">Cetak Hasil Filter</i></button>
                </div>
            </form>
        </div>
        
        <div class="col">
            <div class="d-flex justify-content-end">
                <!--<button type="button" class="btn btn-outline-secondary mr-1" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                </button>-->
                <a href="/cetakrekap" type="button" class="btn btn-outline-dark" ><i class="fas fa-">Cetak Rekapan</i></a>
            </div>
        </div>
    </div>  
        <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #fd6bc5">
              <tr>
                <th width="3%" scope="col">No</th>
                <th width="15%" scope="col">Tanggal</th>
                <th width="15%" scope="col">Di Input Oleh</th>
                <th width="20%" scope="col">Uraian</th>
                <th width="15%" scope="col">Kas Masuk</th>
                <th width="15%" scope="col">Kas Keluar</th>
                <th width="15%" scope="col">Saldo</th>
              </tr>
            </thead>
            <tbody>
                @php
                     $saldo = 0;
                @endphp
                
                @foreach($keuangan as $key => $item)
                @php
                   
                    $saldo = $saldo + ($item->pemasukan - $item->pengeluaran);
                @endphp
                <tr>
                <th scope="row">{{ $key + $keuangan->firstItem()}}</th>
                    <td>{{date('d F Y',strtotime($item->tanggal))}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->deskripsi}}</td>
                    <?php
                    if ($item->pemasukan == 0) {
                        echo "<td></td>";
                    }
                    else {
                          echo "<td>Rp. <z class=\"pull-right\">".number_format(($item->pemasukan) , 0, ',', '.') . ",00"."</z></td>";
                    }
                    ?> 
                    <?php
                    if ($item->pengeluaran == 0) {
                        echo "<td></td>";
                    }
                    else {
                          echo "<td>Rp. <z class=\"pull-right\">".number_format(($item->pengeluaran) , 0, ',', '.') . ",00"."</z></td>";
                    }
                    ?> 
                    <td>Rp. <z class="pull-right"><?php echo number_format($saldo); ?>,00</z></td>
                </tr>
                @endforeach
                <tr style="background: silver;">
                    <td></td>
                    <td></td>
                    <td colspan="2"><center><strong>JUMLAH</strong></center></td>

                    <td><b>Rp. <z class="pull-right"><?=number_format(($masuk) , 0, ',', '.') . ",00"?></z></b></td>
                  	 <td><b>Rp. <z class="pull-right"><?=number_format(($keluar) , 0, ',', '.') . ",00"?></z></b></td>
                  	 <td><b>Rp. <z class="pull-right"><?=number_format(($saldo) , 0, ',', '.') . ",00"?></z></b></td>
                  </tr>
            </tbody>
        </table>
        {{$keuangan->links()}}
        </div>
    </div>
</div>





@endsection
