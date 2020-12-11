@extends('layouts.admin')

@section('content')
<style>
.border-left-primary {
  border-left: 0.25rem solid #4e73df !important;
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
 <!-- Content Row -->
 <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Balita Yang Terdata</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlahBalita}} Balita</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center" >
                <a href="/balita" class="justify-content-center text-decoration-none">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Kas Pemasukan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> Rp.{{number_format(($jumlahMasuk) , 0, ',', '.')}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center" >
                <a href="/kasmasuk" class="justify-content-center text-decoration-none">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kas Pengeluaran
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> Rp.{{number_format(($jumlahKeluar) , 0, ',', '.')}}</div>
                            </div>
                            <div class="col">
                                {{-- <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center" >
                <a href="/kaskeluar" class="justify-content-center text-decoration-none">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
  
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Saldo Akhir</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format(($saldo) , 0, ',', '.')}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center" >
                <a href="/keuangan" class="justify-content-center text-decoration-none">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

@endsection
