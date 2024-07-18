@extends('layouts.admin')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/balita" style="color: #fd6bc5">Data Orang Tua</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Orang Tua</li>
    </ol>
</nav>
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-3 mb-5 bg-white rounded">
            <form action="/orangtua" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="nama_balita">Nama Orang Tua</label>
                    <input autocomplete="off" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"  id="nama" value="{{ old('nama') }}" placeholder="Rudi & Siti">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="alamat">Alamat</label>
                    <input autocomplete="off" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"  id="alamat" value="{{ old('alamat') }}">
                    @error('alamat')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="ket">Keterangan</label>
                    <textarea autocomplete="off" type="text" class="form-control @error('ket') is-invalid @enderror" name="ket"  id="nama" value="{{ old('ket') }}"></textarea>
                    @error('ket')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy'
     });  
</script>

@endsection