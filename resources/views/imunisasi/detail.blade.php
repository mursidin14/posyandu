@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/penimbangan" style="color: #fd6bc5">Data Penimbangan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Data Penimbangan</li>
    </ol>
</nav>
<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
    
   <div class="row">
    <div class="col">
        @foreach ($penimbangan as $item)
        <h3>
            Nama Balita : {{$item->balita->nama_balita}}
        </h3>
        <p>Berat Badan : {{$item->bb}} kilogram</p>
        <p>Tinggi Badan : {{$item->tb}} centimeter</p>
        @endforeach
    </div>
    <div class="col">
        <div class="panel">
            <div id="chartNilai">ssss</div>
        </div>
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

    Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Perkembangan'
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
            text: 'Tanggal '
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:1f} </b></td></tr>',
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