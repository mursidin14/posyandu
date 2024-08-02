@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/jenisImun" style="color: #fd6bc5">Data Nama Imun</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Data Nama Imun</li>
    </ol>
</nav>
<div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="col-md-3">
        <form action="/jenisImun/{{$jenisImun->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name_imun">Nama Imunisasi</label>
                <input type="text" class="form-control @error('name_imun') is-invalid @enderror" name="name_imun"  id="name_imun" value="{{$jenisImun->name_imun}}">
                @error('bb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-success">Simpan</button>
        </form>
        </div>
</div>

@endsection