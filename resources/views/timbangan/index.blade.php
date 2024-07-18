@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Penimbangan</li>
    </ol>
</nav>

<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
    <div class="row">
        <div class="col-md-3">
        <form action="/penimbangan" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="form-group">
                <label for="">Ditimbang Oleh</label>
                <p>{{Auth::user()->name}}</p>
                <input type="number" name="user_id" value="{{ Auth::user()->id }}" hidden>
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Tanggal Penimbangan</label>
                <select name="tanggal_timbang" class="custom-select mr-sm-2 @error('tanggal_timbang') is-invalid @enderror" id="inlineFormCustomSelect">
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
            <div class="form-group" hidden>
                <label for="catatan">Catatan</label>
                <input autocomplete="off" type="text" class="form-control @error('acara_kegiatan') is-invalid @enderror" name="acara_kegiatan"  id="acara_kegiatan" value="{{ $value }}">
                @error('acara_kegiatan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Nama Balita</label>
                <select name="balita_id" class="custom-select mr-sm-2 @error('balita_id') is-invalid @enderror" id="inlineFormCustomSelect">
                    @foreach ($balita as $option)
                        <option value="{{$option->id ?? null}}">{{$option->nama_balita ?? null}}</option>
                    @endforeach
                </select>
            </div>
            @error('bb')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <div class="form-group">
                <label for="bb">Berat Badan</label>
                <input autocomplete="off" type="text" class="form-control @error('bb') is-invalid @enderror" name="bb"  id="bb" value="{{ old('bb') }}" placeholder="kg">
                @error('bb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tb">Tinggi/Panjang Badan</label>
                <input autocomplete="off" type="text" class="form-control @error('tb') is-invalid @enderror" name="tb"  id="tb" value="{{ old('tb') }}" placeholder="cm">
                @error('tb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lika">Lingkar Kepala</label>
                <input autocomplete="off" type="text" class="form-control @error('lika') is-invalid @enderror" name="lika"  id="lika" value="{{ old('lika') }}" placeholder="cm">
                @error('lika')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lila">Lingkar Lengan</label>
                <input autocomplete="off" type="text" class="form-control @error('lila') is-invalid @enderror" name="lila"  id="lila" value="{{ old('lila') }}" placeholder="cm">
                @error('lila')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <input autocomplete="off" type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan"  id="catatan" value="{{ old('tb') }}" placeholder="keterangan">
                @error('catatan')
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
            <div class="col-6">
                <form action="{{url('/filter/periodeTimbang')}}" method="get">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                            <input class="form-control dateselect" type="text" name="dari" id="" autocomplete="off" value="{{$dari}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <input class="form-control dateselect" type="text" name="sampai" id="" autocomplete="off"value="{{$sampai}}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-secondary" ><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #fd6bc5">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Penimbangan</th>
                <th scope="col">Nama Balita</th>
                <th scope="col">Berat Badan</th>
                <th scope="col">Tinggi Badan</th>
                <th scope="col">Lingkar Kepala</th>
                <th scope="col">Lingkar Lengan</th>
                <th scope="col">Ditimbang Oleh</th>
                <th scope="col">Nama Kegiatan</th>
                <th scope="col">Catatan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach($timbangan as $key => $item)
                <tr class="clickable-row" data-href="/penimbangan/{{$item->id}}">
                <th scope="row" >{{ $key + $timbangan->firstItem()}}</th>
                    <td>{{date('d F Y',strtotime($item->tanggal_timbang))}}</td>
                    <td >{{$item->balita->nama_balita}}</td>
                    <td>{{$item->bb}} kg</td>
                    <td>{{$item->tb}} cm</td>
                    <td>{{$item->lika}} cm</td>
                    <td>{{$item->lila}} cm</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->acara_kegiatan}}</td>
                    <td>{{$item->catatan}}</td>
                    <td>
                        <form action="/penimbangan/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <a href="/penimbangan/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection