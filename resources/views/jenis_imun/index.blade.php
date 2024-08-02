@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Jenis Imunisasi</li>
    </ol>
</nav>

<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
    <div class="row">
        <div class="col-md-3">
        <form action="/jenisimun" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="form-group">
                <label for="name_imun">Nama Imunisasi</label>
                <input autocomplete="off" type="text" class="form-control @error('name_imun') is-invalid @enderror" name="name_imun"  id="name_imun" value="{{ old('name_imun') }}">
                @error('name_imun')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="usia_pakai">Usia Pemakaian</label>
                <input autocomplete="off" type="text" class="form-control @error('usia_pakai') is-invalid @enderror" name="usia_pakai"  id="usia_pakai" value="{{ old('usia_pakai') }}">
                @error('usia_pakai')
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
<div style="padding-bottom:200px">
    <div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
        <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #fd6bc5">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Imunisasi</th>
                <th scope="col">Usia Pemakaian</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach($jenisImun as $key => $item)
                <tr class="clickable-row" data-href="/jenisimun/{{$item->id}}">
                    <td>{{ $key + 1 }}</td>
                    <td>{{$item->name_imun}}</td>
                    <td>{{$item->usia_pakai}}</td>
                    <td>
                        <form action="/jenisimun/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <a href="/jenisimun/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $jenisImun->links() }}
        </div>
    </div>
</div>

@endsection

@section('footer')

@endsection