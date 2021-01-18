<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div style="text-align: center;">
        <h3 style="text-align: center;">LAPORAN KAS KELUAR</h3>
        <h1 style="text-align: center;">POSYANDU SERUNI 3</h1>
        <p style="text-align: center;"> {{date('d F Y',strtotime($dari))}} - {{date('d F Y',strtotime($sampai))}}</p>
        <hr>
       
    </div>
    <div class="table-responsive">
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead style="background: #fd6bc5" {{--#1cc88a--}}>
          <tr>
            <th width="3%" scope="col">No.</th>
            <th width="25%" scope="col">Tanggal</th>
            <th width="35%" scope="col">Uraian</th>
            <th width="15%" scope="col">Jumlah</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach($keluar as $key => $item)
            <tr>
            <th scope="row">{{ $key + $keluar->firstItem()}}</th>
                <td>{{date('d F Y',strtotime($item->tanggal))}}</td>
                <td>{{$item->deskripsi}}</td>
                <td>Rp.{{number_format(($item->pengeluaran) , 0, ',', '.')}},00</td>
                @endforeach
                <tr style="background: silver;">
                    <td></td>
                    <td colspan="2"><center><strong>JUMLAH KAS KELUAR</strong></center></td>
                    <td><strong>Rp.{{number_format(($jumlah) , 0, ',', '.')}},00</strong></td>
                </tr>
            </tr>
        </tbody>
    </table>
    
    <div style="float: right;padding: 10px;">
    <p>Semarang, </p>
    <p>Ketua Kader Posyandu</p>
        <br>
        <br>
        <br>
    <p>Ita Sujarwo</p>
    </div>
    </div>
</body>
</html>