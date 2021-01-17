@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/keuangan" style="color: #fd6bc5">Data Keuangan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Kas Keluar</li>
    </ol>
</nav>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input Data Kas Keluar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/keuangan" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <input class=" form-control" name="jenis" type="text" style="display:none;" value="pemasukan">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Kas Keluar</label>
                            <div class="input-group mb-3">
                                <input class="dateselect form-control" name="tanggal" type="text" placeholder="Tahun-Bulan-Tanggal" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
                                </div>
                            </div>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="pengeluaran">Kas Masuk</label>
                            <input type="text" class="form-control @error('pengeluaran') is-invalid @enderror" name="pengeluaran"  id="pengeluaran" value="{{ old('pengeluaran') }}" placeholder="Rp." autocomplete="off">
                            @error('pengeluaran')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Uraian</label>
                    <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"  id="nama" value="{{ old('deskripsi') }}" autocomplete="off"></textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-dark">Simpan Data</button>
            </form>
        </div>
      </div>
    </div>
  </div>
<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
  <div class="row mb-3" >
    <div class="col">
        <form action="{{url('/filter/periodeKasKeluar')}}" method="get">
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
                {{-- <button type="submit">Submit</button> --}}
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
        <form action="{{url('/filter/cetakpdfkeluar')}}" method="get" >
            <input type="text" name="dari" style="display: none" value="{{$dari}}">
            <input type="text" name="sampai" style="display: none" value="{{$sampai}}">
            <div class="dari">
                <button type="submit" style="display: block;" class="btn btn-outline-dark" ><i class="fas fa-">Cetak PDF</i></button>
            </div>
        </form>
    </div>
    <div class="col">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div>
    </div>
</div>
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

    <div class="table-responsive">
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead style="background: #fd6bc5">
          <tr>
            <th width="3%" scope="col">No</th>
            <th width="15%" scope="col">Tanggal</th>
            <th width="50%" scope="col">Uraian</th>
            <th width="15%" scope="col">Jumlah</th>
            <th width="10%" scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach($keluar as $key => $item)
            <tr>
            <th scope="row">{{ $key + $keluar->firstItem()}}</th>
                <td>{{date('d F Y',strtotime($item->tanggal))}}</td>
                <td>{{$item->deskripsi}}</td>
                <td>Rp.{{number_format(($item->pengeluaran) , 0, ',', '.')}},00</td>
                {{-- <td>{{$sum}}</td> --}}
                <td>
                    <form action="/keuangan/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data?')">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                    </form>
                    <a href="/keuangan/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
                </td>
                @endforeach
                <tr style="background: silver;">
                    <td></td>
                    <td colspan="2"><center><strong>JUMLAH KAS KELUAR</strong></center></td>
                    <td><strong>Rp.{{number_format(($jumlah) , 0, ',', '.')}},00</strong></td>
                    <td></td>
                </tr>
             
            </tr>
        </tbody>
        
    </table>
    {{$keluar->links()}}
    </div>

@endsection