<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    @foreach ($keuangan as $item)
    <div class="container">
        <div class="card">
            <div class="card-body">
                {{$item->jenis}}
                <br>
                {{$item->deskripsi}}
                <br>
                {{$item->tanggal}}
                <br>
                {{$item->pemasukan}} 
            </div>
        </div>
    </div>
        
    @endforeach
   
    
</body>
</html>