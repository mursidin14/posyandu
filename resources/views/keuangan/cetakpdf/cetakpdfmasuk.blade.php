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
        <h3 style="text-align: center;">LAPORAN KAS MASUK </h3>
        <h1 style="text-align: center;">POSYANDU SERUNI III </h1>
        <p style="text-align: center;"> {{date('d F Y',strtotime($dari))}} - {{date('d F Y',strtotime($sampai))}}</p>
        <hr>
       
    </div>
    <div class="table-responsive">
    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead style="background: #1cc88a">
          <tr>
            <th width="3%" scope="col">No</th>
            <th width="25%" scope="col">Tanggal</th>
            <th width="35%" scope="col">Uraian</th>
            <th width="15%" scope="col">Jumlah</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach($masuk as $key => $item)
            <tr>
            <th scope="row">{{ $key + $masuk->firstItem()}}</th>
                <td>{{date('d F Y',strtotime($item->tanggal))}}</td>
                <td>{{$item->deskripsi}}</td>
                <td>Rp.{{number_format(($item->pemasukan) , 0, ',', '.')}},00</td>
                @endforeach
                <tr style="background: silver;">
                    <td></td>
                    <td colspan="2"><center><strong>JUMLAH KAS MASUK</strong></center></td>
                    <td><strong>Rp.{{number_format(($jumlah) , 0, ',', '.')}},00</strong></td>
                </tr>
            </tr>
        </tbody>
    </table>
    
    <div style="float: right;padding: 10px;">
    <p>Semarang, </p>
    <p>Ketua Yayasan</p>
        <br>
        <br>
        <br>
    <p>Drs.H. Muhammad Hamzah</p>
    </div>
    </div>
</body>
</html>