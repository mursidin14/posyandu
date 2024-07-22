@extends('layouts.admin')

@section('content')
<style>
    .border-left-primary {
      border-left: 0.25rem solid #fd6bc5/* #4e73df*/ !important;
    }
    .border-left-secondary {
      border-left: 0.25rem solid #858796 !important;
    }
    .border-left-success {
      border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
      border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
      border-left: 0.25rem solid #f6c23e !important;
    }
    .border-left-danger {
      border-left: 0.25rem solid #e74a3b !important;
    }
    .border-left-light {
      border-left: 0.25rem solid #f8f9fc !important;
    }
    .border-left-dark {
      border-left: 0.25rem solid #5a5c69 !important;
    }
    </style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Kelahiran</li>
    </ol>
</nav>
<div class="">
    @if (session('status'))
        <div class="alert alert-success">
                {{ session('status') }}
        </div>
    @endif
<div class="">
    <div class="card border-left-primary shadow p-3 mb-5 bg-white rounded">
        <div class="d-flex justify-content-lg-end mb-3">
            <a class="btn btn-outline-secondary" href="/kelahiran/create"><span class="icon text">
                <i class="fas fa-plus"></i>
            </span>Tambah Data</a>
    
        </div>
        <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #fd6bc5" {{--#1cc88a--}}>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Ibu</th>
                <th scope="col">Nama Ayah</th>
                <th scope="col">Nama Bayi</th>
                <th scope="col">Lahiran Ke-</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Status Ibu</th>
                <th scope="col">Status Bayi</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach($kelahiran as $key => $item)
                <tr>
                <th scope="row">{{ $key + $kelahiran->firstItem()}}</th>
                    <td>{{$item->orangtua->nama}}</td>
                    <td>{{$item->ayah->nama}}</td>
                    <td>{{$item->balita->nama_balita}}</td>
                    <td>{{$item->jumlah_lahiran}}</td>
                    <td>{{$item->tgl}}</td>
                    <td>{{$item->jenis_kelamin}}</td>
                    <td>{{$item->status_ibu}}</td>
                    <td>{{$item->status_bayi}}</td>
                    <td>
                        <form action="/kelahiran/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                        {{-- <a href="/balita/{{$item->id}}" class="btn btn-primary" ><i class="fas fa-search"></i></a>  --}}
                        <a href="/kelahiran/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        {{$kelahiran->links()}}
        </div>
    </div>
</div>

@endsection
