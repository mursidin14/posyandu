@extends('layouts.admin')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-3 mb-5 bg-white rounded">
            <form action="/balita" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="nama_balita">Nama Balita</label>
                    <input autocomplete="off" type="text" class="form-control @error('nama_balita') is-invalid @enderror" name="nama_balita"  id="nama_balita" value="{{ old('nama_balita') }}">
                    @error('nama_balita')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="tpt_lahir">Tempat Lahir</label>
                            <input autocomplete="off" type="text" class="form-control @error('tpt_lahir') is-invalid @enderror" name="tpt_lahir"  id="tpt_lhr" value="{{ old('tpt_lahir') }}">
                            @error('tpt_lahir')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input autocomplete="off" type="text" class="date form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"  id="tgl_lahir" value="{{ old('tgl_lahir') }}">
                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
           
           
                <div class="form-group mt-2">
                    <label for="nama_orangtua">Nama Orangtua</label>
                    <input autocomplete="off" type="text" class="form-control @error('nama_orangtua') is-invalid @enderror" name="nama_orangtua"  id="nama_orangtua" value="{{ old('nama_orangtua') }}">
                    @error('nama_orangtua')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="pendidikan">Pendidikan</label>
                    <input autocomplete="off" type="text" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan"  id="pendidikan" value="{{ old('pendidikan') }}">
                    @error('pendidikan')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input autocomplete="off" type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan"  id="nama" value="{{ old('pekerjaan') }}">
                    @error('pekerjaan')
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
                <button type="submit" class="btn btn-outline-dark">Simpan Data</button>
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