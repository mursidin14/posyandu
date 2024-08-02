@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="/jenisimun" style="color: #fd6bc5">Data Nama Imunisasi</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Data Nama Imunisai</li>
    </ol>
</nav>
<div class="card shadow p-3 mb-5 bg-white rounded border-left-primary">
    
   <div class="row">
    <div class="col">
        @foreach ($JenisImun as $item)
        <h3>
            Nama Imun : {{$item->name_imun}}
        </h3>
        <h3>
            Usia Pemakaian : {{$item->usia_pakai}}
        </h3>
        @endforeach
    </div>
   </div>
</div>
@endsection
@section('footer')

              
</script>
@endsection