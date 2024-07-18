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
      <li class="breadcrumb-item active" aria-current="page">Data Balita</li>
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
            <a class="btn btn-outline-secondary" href="/balita/create"><span class="icon text">
                <i class="fas fa-plus"></i>
            </span>Tambah Data</a>
    
        </div>
        <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #fd6bc5" {{--#1cc88a--}}>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nik</th>
                <th scope="col">Nama</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Umur</th>
                <th scope="col">Nama Orangtua</th>
                <th scope="col">Alamat</th>
                <th scope="col">RT/RW</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                @foreach($balita as $key => $item)
                <tr>
                <th scope="row">{{ $key + $balita->firstItem()}}</th>
                    <td>{{$item->nik}}</td>
                    <td>{{$item->nama_balita}}</td>
                    <td>{{$item->tpt_lahir}}</td>
                    <td>{{$item->tgl_lahir}}</td>
                    <td>{{$item->jenis_kelamin}}</td>
                    <td>{{$item->umur}}</td>
                    <td>{{$item->orangtua->nama}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->rt_rw}}</td>
                    <td>{{$item->ket}}</td>
                    <td>
                        <form action="/balita/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                        {{-- <a href="/balita/{{$item->id}}" class="btn btn-primary" ><i class="fas fa-search"></i></a>  --}}
                        <a href="/balita/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        {{$balita->links()}}
        </div>
    </div>
</div>

@endsection
