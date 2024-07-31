@extends('layouts.admin')

@section('content')
<style>
    .border-left-primary {
      border-left: 0.25rem solid #fd6bc5/* #4e73df*/ !important;
    }
    .border-left-secondary {
      border-left: 0.25rem solid #858796 !important;
    }
    .border-left-success {
      border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
      border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
      border-left: 0.25rem solid #f6c23e !important;
    }
    .border-left-danger {
      border-left: 0.25rem solid #e74a3b !important;
    }
    .border-left-light {
      border-left: 0.25rem solid #f8f9fc !important;
    }
    .border-left-dark {
      border-left: 0.25rem solid #5a5c69 !important;
    }
    </style>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Laporan</li>
    </ol>
</nav>
<div class="">
    @if (session('status'))
        <div class="alert alert-success">
                {{ session('status') }}
        </div>
    @endif
    <!-- Form untuk filter laporan -->
    <form action="{{ route('laporan.index') }}" method="GET">
      <div class="form-group">
          <label for="bulan">Bulan:</label>
          <select name="bulan" id="bulan" class="form-control">
              <option value="">Pilih Bulan</option>
              @for ($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
          </select>
      </div>
      <div class="form-group">
          <label for="tahun">Tahun:</label>
          <select name="tahun" id="tahun" class="form-control">
              <option value="">Pilih Tahun</option>
              @for ($i = 2020; $i <= now()->year; $i++)
                  <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
          </select>
      </div>
      <button type="submit" class="btn btn-primary">Filter</button>
      <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Reset</a>
      <a href="{{ route('laporan.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="btn btn-success">Export PDF</a>
  </form>

  <!-- Tabel laporan -->
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

@endsection
