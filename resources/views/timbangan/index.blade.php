@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      
      <li class="breadcrumb-item active" aria-current="page">Data Timbangan</li>
    </ol>
</nav>

<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
    <div class="row">
        <div class="col-md-3">
        <form action="/penimbangan" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="form-group">
                <label for="tanggal_timbang">Tanggal Penimbangan</label>
                <div class="input-group mb-3">
                    <input class="dateselect form-control" name="tanggal_timbang" type="text" placeholder="Tahun-Bulan-Tanggal" autocomplete="off">
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
                <select name="balita_id" class="custom-select mr-sm-2 @error('balita_id') is-invalid @enderror" id="inlineFormCustomSelect">
                    <option selected>Nama Balita...</option>
                    @foreach ($balita as $option)
                        <option value="{{$option->id}}">{{$option->nama_balita}}</option>
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
                <input autocomplete="off" type="text" class="form-control @error('bb') is-invalid @enderror" name="bb"  id="bb" value="{{ old('bb') }}">
                @error('bb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tb">Tinggi Badan</label>
                <input autocomplete="off" type="text" class="form-control @error('tb') is-invalid @enderror" name="tb"  id="tb" value="{{ old('tb') }}">
                @error('tb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-dark">Simpan Data</button>
        </form>
        </div>
        <div class="col">
            <div class="panel">
                <div id="chartNilai">ssss</div>
            </div>
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
<div class="">
    <div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
        <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #1cc88a">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Ditimbang Tanggal</th>
                <th scope="col">Nama Balita</th>
                <th scope="col">Berat Badan</th>
                <th scope="col">Tinggi Badan</th>
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
                    <td>
                        <form action="/penimbangan/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <a href="/penimbangan/{{$item->id}}/edit" class="btn btn-success" ><i class="fas fa-edit"></i></a> 
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
    
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>

    //clickable Row
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
    });

    //Source Code Chart
    Highcharts.chart('chartNilai', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Chart Data Balita'
    },
    subtitle: {
        text: 'Source: posyanduseruni3.com'
    },
    xAxis: {
        categories: {!!json_encode($chart)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (kg/cm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Berat Badan',
        data: {!!json_encode($beratBadan)!!}

    }, {
        name: 'Tinggi Badan',
        data: {!!json_encode($tinggiBadan)!!}

    },]
});
              
</script>
@endsection