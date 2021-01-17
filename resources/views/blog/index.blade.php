@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Jadwal Pelayanan</li>
    </ol>
</nav>
@if (session('status'))
<div class="alert alert-success">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif
<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
  <div class="card-header">
    Jadwal Pelayanan Posyandu
  </div>
  <div class="card-body">
    <div class="col-md-3">
    <form action="/blog" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="tanggal_kegiatan">Tanggal Pelayanan</label>
            <div class="input-group mb-3">
                <input autocomplete="off" class="dateselect form-control" name="tanggal_kegiatan" type="text" placeholder="Tahun-Bulan-Tanggal" >
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
                </div>
                @error('tanggal_kegiatan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="nama_kegiatan">Nama Pelayanan / Kegiatan</label>
            <input autocomplete="off" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan"  id="nama_kegiatan	" value="{{ old('nama_kegiatan') }}">
            @error('nama_kegiatan')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="waktu">Jam Pelayanan</label>
            <input autocomplete="off" placeholder="00:00" type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktu"  id="waktu	" value="{{ old('waktu') }}">
            @error('waktu')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-success">Simpan</button>
    </form>
    </div>
    <div class="m-4">
      <table class="table table-hover">
        <thead style="background: #fd6bc5">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal Pelayanan</th>
            <th scope="col">Nama Pelayanan/Kegiatan</th>
            <th scope="col">Jam Pelayanan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
              $i=1;
          @endphp
          @foreach ($jadwal as $item) 
          <tr>
          <th scope="row">{{$i++}}</th>
          <td>{{date('d F Y',strtotime($item->tanggal_kegiatan))}}</td>
            <td>{{$item->nama_kegiatan}}</td>
            <td>{{$item->waktu}}</td>
            <td>
              <form action="/blog/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
              </form>
              {{-- <a href="/blog/{{$item->id}}" class="btn btn-primary" ><i class="fas fa-search"></i></a>  --}}
              <a href="/blog/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>




  </div>
</div>
@endsection