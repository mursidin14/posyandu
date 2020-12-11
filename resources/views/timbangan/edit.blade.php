@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/penimbangan">Data Penimbangan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Data Penimbangan</li>
  
    </ol>
</nav>
<div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="col-md-3">
        <form action="/penimbangan/{{$penimbangan->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="tanggal_timbang">Tanggal Penimbangan</label>
                <div class="input-group mb-3">
                <input class="dateselect form-control" name="tanggal_timbang" type="text" value="{{$penimbangan->tanggal_timbang}}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
                    </div>
                    @error('tanggal_timbang')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Nama Balita</label>
                <select name="balita_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option value="{{$penimbangan->balita->id}}" selected>{{$penimbangan->balita->nama_balita}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bb">Berat Badan</label>
                <input type="text" class="form-control @error('bb') is-invalid @enderror" name="bb"  id="bb" value="{{$penimbangan->bb}}">
                @error('bb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tb">Tinggi Badan</label>
                <input type="text" class="form-control @error('tb') is-invalid @enderror" name="tb"  id="tb" value="{{ $penimbangan->tb }}">
                @error('tb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-dark">Simpan Data</button>
        </form>
        </div>
</div>

@endsection