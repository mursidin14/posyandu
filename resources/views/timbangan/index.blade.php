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
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <input autocomplete="off" type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan"  id="catatan" value="{{ old('tb') }}">
                @error('catatan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-success">Simpan</button>
        </form>
        </div>
        <div class="col">
            <div class="panel">
                <div id="chartNilai1">ssss</div>
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
    
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('chartNilai1', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Jenis Kelamin'
    },
    subtitle: {
        text: 'Source: Posyandu Seruni'
    },
    xAxis: {
        categories: ['Jenis Kelamin', 'Umur'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Population (Balita)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: 'Balita'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Laki Laki',
        // data: [107, 31, 635, 203, 2]
        data: {!! json_encode($laki) !!}
    }, {
        name: 'Perempuan',
        // data: [133, 156, 947, 408, 6]
        data: {!! json_encode($perem) !!}
    }]
});
            
  </script>
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
        text: 'Grafik Data Balita'
    },
    subtitle: {
        text: 'Sumber: posyanduseruni3.com'
    },
    xAxis: {
        categories: {!!json_encode($chart)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'BB/TB (kg/cm)'
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