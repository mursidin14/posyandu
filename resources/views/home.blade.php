@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 150px">
        <div class="col-md-3">
            <div class="card">
                <center><div class="card-header" style="background: #ff7ec9; color: white;">{{ __('Dashboard') }}</div></center>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Yeay, sudah berhasil log in! ^^') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
