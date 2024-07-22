@extends('layouts.admin')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/kelahiran" style="color: #fd6bc5">Data Kelahiran</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Data Kelahiran</li>
    </ol>
</nav>
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-3 mb-5 bg-white rounded">
            <form action="/kelahiran" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="inlineFormCustomSelect">Nama Ibu</label>
                    <select name="orang_tua_id" class="custom-select mr-sm-2 @error('orang_tua_id') is-invalid @enderror" id="inlineFormCustomSelect">
                        @foreach ($orangTua as $option)
                         <option value="{{$option->id ?? null}}">{{$option->nama ?? null}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="inlineFormCustomSelect">Nama Ayah</label>
                    <select name="ayah_id" class="custom-select mr-sm-2 @error('ayah_id') is-invalid @enderror" id="inlineFormCustomSelect">
                        @foreach ($ayah as $option)
                         <option value="{{$option->id ?? null}}">{{$option->nama ?? null}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="inlineFormCustomSelect">Nama Bayi</label>
                    <select name="balita_id" class="custom-select mr-sm-2 @error('balita_id') is-invalid @enderror" id="inlineFormCustomSelect">
                        @foreach ($balita as $option)
                         <option value="{{$option->id ?? null}}">{{$option->nama_balita ?? null}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="Lahiran Ke-">Lahiran Ke-</label>
                            <input autocomplete="off" type="number" class="form-control @error('jumlah_lahiran') is-invalid @enderror" name="jumlah_lahiran"  id="jumlah_lahiran" value="{{ old('jumlah_lahiran') }}" placeholder="3">
                            @error('jumlah_lahiran')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Lahir</label>
                            <input autocomplete="off" type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl"  id="tgl" value="{{ old('tgl') }}" placeholder="1/7/2024">
                            @error('tgl')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="custom-select mr-sm-2 @error('jenis_kelamin') is-invalid @enderror" id="inlineFormCustomSelect">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status_ibu">Status Ibu</label>
                            <select name="status_ibu" class="custom-select mr-sm-2 @error('status_ibu') is-invalid @enderror" id="inlineFormCustomSelect">
                                <option value="Selamat">Selamat</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                            @error('status_ibu')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status_bayi">Status Bayi</label>
                            <select name="status_bayi" class="custom-select mr-sm-2 @error('status_bayi') is-invalid @enderror" id="inlineFormCustomSelect">
                                <option value="Selamat">Selamat</option>
                                <option value="Meninggal">Meninggal</option>
                            </select>
                            @error('status_bayi')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>

@endsection