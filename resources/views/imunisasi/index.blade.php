@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Imunisasi</li>
    </ol>
</nav>

<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
    <div class="row">
        <div class="col-md-3">
        <form action="/imunisasi" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="form-group">
                <label for="inlineFormCustomSelect">Tanggal Imunisasi</label>
                <select name="tanggal_imun" class="custom-select mr-sm-2 @error('tanggal_imun') is-invalid @enderror" id="inlineFormCustomSelect">
                    @php
                        $value = '';
                    @endphp
                    @foreach ($tanggalPelayanan as $option)
                        <option value="{{$option->tanggal_kegiatan ?? null}}">
                            {{$option->tanggal_kegiatan." - ".$value = $option->nama_kegiatan ?? null}}
                        
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Nama Balita</label>
                <select name="balita_id" class="custom-select mr-sm-2 @error('balita_id') is-invalid @enderror" id="inlineFormCustomSelect">
                    @foreach ($balita as $option)
                        <option value="{{$option->id ?? null}}">{{$option->nama_balita ?? null}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="umur">Umur Balita</label>
                <input autocomplete="off" type="text" class="form-control @error('umur') is-invalid @enderror" name="umur"  id="umur" value="{{ old('umur') }}">
                @error('umur')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jenis_imun">Jenis Imunisasi</label>
                <input autocomplete="off" type="text" class="form-control @error('jenis_imun') is-invalid @enderror" name="jenis_imun"  id="jenis_imun" value="{{ old('jenis_imun') }}">
                @error('jenis_imun')
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
                <th scope="col">Tanggal Imunisasi</th>
                <th scope="col">Nama Balita</th>
                <th scope="col">Umur Balita</th>
                <th scope="col">Jenis Imunisasi</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach($imunisasi as $key => $item)
                <tr class="clickable-row" data-href="/imunisasi/{{$item->id}}">
                {{-- <th scope="row" >{{ $key + $item->firstItem()}}</th> --}}
                    <td>{{ $key + 1 }}</td>
                    <td>{{$item->tanggal_imun}}</td>
                    <td >{{$item->balita->nama_balita}}</td>
                    <td>{{$item->umur}}</td>
                    <td>{{$item->jenis_imun}}</td>
                    <td>
                        <form action="/imunisasi/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <a href="/imunisasi/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $imunisasi->links() }}
        </div>
    </div>
</div>

@endsection

@section('footer')

@endsection