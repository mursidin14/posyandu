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
        <h3 style="text-align: center;">LAPORAN REKAPITULASI KAS </h3>
        <h1 style="text-align: center;">POSYANDU SERUNI III </h1>
        <p style="text-align: center;">Semua Data</p>
        <hr>
       
    </div>
    <div class="table-responsive">
		<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #1cc88a">
              <tr>
                <th width="3%" scope="col">No</th>
                <th width="15%" scope="col">Tanggal</th>
                <th width="35%" scope="col">Uraian</th>
                <th width="15%" scope="col">Pemasukan</th>
                <th width="15%" scope="col">Pengeluaran</th>
                <th width="15%" scope="col">Saldo</th>
              </tr>
            </thead>
            <tbody>
                @php
                     $saldo = 0;
                @endphp
                
                @foreach($rekap as $key => $item)
                @php
                   
                    $saldo = $saldo + ($item->pemasukan - $item->pengeluaran);
                @endphp
                <tr>
                <th scope="row">{{ $key + $rekap->firstItem()}}</th>
                    <td>{{date('d F Y',strtotime($item->tanggal))}}</td>
                    <td>{{$item->deskripsi}}</td>
                    <?php
                    if ($item->pemasukan == 0) {
                        echo "<td></td>";
                    }
                    else {
                          echo "<td>Rp. <z class=\"pull-right\">".number_format(($item->pemasukan) , 0, ',', '.') . ",00"."</z></td>";
                    }
                    ?> 
                    <?php
                    if ($item->pengeluaran == 0) {
                        echo "<td></td>";
                    }
                    else {
                          echo "<td>Rp. <z class=\"pull-right\">".number_format(($item->pengeluaran) , 0, ',', '.') . ",00"."</z></td>";
                    }
                    ?> 
                    <td>Rp. <z class="pull-right"><?php echo number_format($saldo); ?>,00</z></td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td colspan="2"><center><strong>JUMLAH</strong></center></td>

                    <td><b>Rp. <z class="pull-right"><?=number_format(($masuk) , 0, ',', '.') . ",00"?></z></b></td>
                  	 <td><b>Rp. <z class="pull-right"><?=number_format(($keluar) , 0, ',', '.') . ",00"?></z></b></td>
                  	 <td><b>Rp. <z class="pull-right"><?=number_format(($saldo) , 0, ',', '.') . ",00"?></z></b></td>
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