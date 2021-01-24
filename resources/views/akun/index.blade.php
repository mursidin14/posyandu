@extends('layouts.admin')

@section('content')
<!--<<<<<<< HEAD-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/dashboard" style="color: #fd6bc5">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Akun User</li>
    </ol>
</nav>
<!--=======-->
@if (session('status'))
<div class="alert alert-success">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
@endif
{{-->>>>>>> eb8e3376f15335c8730886b0a3f0f2c7c59af3d1--}}
<div class="">
    <div class="card border-left-primary shadow p-3 mb-5 bg-white rounded">
        <div class="d-flex justify-content-lg-end mb-3">
            <a class="btn btn-outline-secondary" href="/akun/create"><span class="icon text">
                <i class="fas fa-plus"></i>
            </span>Tambah Data Kader</a>
    
        </div>
        <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead style="background: #fd6bc5">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Akun</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Akun Dibuat</th>
                <th scope="col">Aksi</th>
            
              </tr>
            </thead>
            <tbody>
                
                <?php $i=1; ?>
              
                @foreach($akun as $key => $item)
                <tr>
                <th scope="row">{{ $key + $akun->firstItem()}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->password}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        
                        <form action="/akun/{{$item->id}}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" ><i class="fas fa-trash-alt"></i></button>
                        </form>
                        {{-- <a href="/akun/{{$item->id}}" class="btn btn-primary" ><i class="fas fa-search"></i></a>  --}}
                        <a href="/akun/{{$item->id}}/edit" class="btn btn-primary" ><i class="fas fa-edit"></i></a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        {{-- {{$akun->links()}} --}}
        </div>
    </div>
</div>

@endsection