<table>
    <thead>
        <tr>
            <th>NIK</th>
            <th>Nama Balita</th>
            <th>Jenis Kelamin</th>
            <th>Berat Badan (BB)</th>
            <th>Tinggi Badan (TB)</th>
            <th>Lingkar Kepala (LIKA)</th>
            <th>Lingkar Lengan Atas (LILA)</th>
            <th>Umur</th>
            <th>Jenis Imunisasi</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $row)
        <tr>
            <td>'{{ $row->nik }}</td>
            <td>{{ $row->nama_balita }}</td>
            <td>{{ $row->jenis_kelamin }}</td>
            <td>{{ $row->bb }}</td>
            <td>{{ $row->tb }}</td>
            <td>{{ $row->lika }}</td>
            <td>{{ $row->lila }}</td>
            <td>{{ $row->umur }}</td>
            <td>{{ $row->jenis_imun }}</td>
            <td>{{ $row->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
