@extends('layouts.admin')

@section('content')
@php
if($keuangan->pemasukan  == null){
    echo'<style>.hdn1{display:none;}</style>';
}
else {
    echo'<style>.hdn2{display:none;}</style>';
}
@endphp
<form action="/keuangan/{{$keuangan->id}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <input class=" form-control" name="jenis" type="text" style="display:none;" value="pemasukan">
    <div class="row" class="hide">
        <div class="col">
            <div class="form-group">
                <label for="tanggal">Tanggal Input Kas</label>
                <div class="input-group mb-3">
                <input class="dateselect form-control" name="tanggal" type="text" value="{{$keuangan->tanggal}}" autocomplete="off">
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
    <div class="hdn1">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="pemasukan">Kas Masuk</label>
                    <input type="text" class="form-control @error('pemasukan') is-invalid @enderror" name="pemasukan"  id="pemasukan" value="{{ $keuangan->pemasukan }}" placeholder="Rp." autocomplete="off">
                    @error('pemasukan')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="hdn2">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="pengeluaran">Kas Keluar</label>
                    <input type="text" class="form-control @error('pengeluaran') is-invalid @enderror" name="pengeluaran"  id="pengeluaran" value="{{ $keuangan->pengeluaran }}" placeholder="Rp." autocomplete="off">
                    @error('pengeluaran')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="deskripsi">Uraian</label>
        <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"  id="nama"  autocomplete="off">{{ $keuangan->deskripsi }}</textarea>
        @error('deskripsi')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-outline-dark">Simpan Data</button>
</form>
@endsection