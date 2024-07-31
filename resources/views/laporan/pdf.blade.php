<!DOCTYPE html>
<html>
<head>
    <title>Laporan Anak</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Balita</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>BB</th>
                <th>TB/PB</th>
                <th>LIKa</th>
                <th>LILA</th>
                <th>Umur</th>
                <th>Jenis Imun</th>
                {{-- <th>Alamat</th> --}}
                {{-- <th>Keterangan</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama_balita }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->bb }}</td>
                    <td>{{ $item->tb }}</td>
                    <td>{{ $item->lika }}</td>
                    <td>{{ $item->lila }}</td>
                    <td>{{ $item->umur }}</td>
                    <td>{{ $item->jenis_imun }}</td>
                    {{-- <td>{{ $item->alamat }}</td> --}}
                    {{-- <td>{{ $item->ket }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
          
            window.print();
          
        })
      </script>
</body>
</html>
