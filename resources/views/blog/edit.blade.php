@extends('layouts.admin')

@section('content')
<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
<form action="/blog/{{$jadwal->id}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="form-group">
        <label for="tanggal_kegiatan">Tanggal Penimbangan</label>
        <div class="input-group mb-3">
            <input autocomplete="off" class="dateselect form-control" name="tanggal_kegiatan" type="text" value="{{$jadwal->tanggal_kegiatan}}">
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
        <label for="nama_kegiatan">Nama Layanan / Kegiatan</label>
        <input autocomplete="off" type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan"  id="nama_kegiatan	" value="{{$jadwal->nama_kegiatan}}">
        @error('nama_kegiatan')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="waktu">Jam Pelayanan</label>
        <input autocomplete="off" placeholder="00:00" type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktu"  id="waktu	" value="{{$jadwal->waktu}}">
        @error('waktu')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-outline-dark">Simpan Data</button>
</form>
</div>

@endsection