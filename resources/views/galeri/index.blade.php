@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
{{--<<<<<<< HEAD--}}
        <li class="breadcrumb-item"><a href="/dashboard" style="color: #ff7ec9">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Galeri</li>
{{--=======--}}
      
{{-->>>>>>> eb8e3376f15335c8730886b0a3f0f2c7c59af3d1--}}
    </ol>
</nav>
<div class="">
    @if (session('status'))
        <div class="alert alert-success">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif
</div>
<div class="">
    <div class="card shadow p-3 mb-2 bg-white rounded border-left-primary">
        <form action="/gallery" method="post"  enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="form-group">
                <label for="">Diupload Oleh</label>
                <p>{{Auth::user()->name}}</p>
                <input type="number" name="user_id" value="{{ Auth::user()->id }}" hidden>
            </div>
            <label for="l_name">
                Nama Gambar
            </label>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
            </div>
            <label for="image_broadcast">Gambar</label>
            <div class="col-md-9">
                <div class="form-group">
                    <div class="col-md-8 ">
                        <div class="d-flex justify-content-center">
                            <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id="msg"></div>
                        <input type="file" name="image_broadcast" class="file" accept="image/*" hidden>
                        <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                            <div class="input-group-append">
                            <button type="button" class="browse btn btn-primary">Browse...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

{{-- Gambar --}}
<div class="row row-cols-2 row-cols-md-5 m-1">
    @foreach($gallery as $key => $item)
        <div class="card m-1" style="width: 18rem;">
            <div class="row">
                <div class="col float-left">
                    <p class="float-left"><strong>{{$item->name}}</strong></p>
                </div>
                <div class="col">
                    <form class="float-right" method="post" action="/gallery/{{$item->id}}">
                        @csrf
                        @method('delete')
                        <a href="/gallery/{{$item->id}}/edit" class="btn btn-success p-2"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger p-2" type="submit"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="float-right">
                <p style="float: right;">Diupload Oleh {{$item->user->name}}</p>
            </div>
            <img src="{{ url('/storage/'.$item->image) }}" class="card-img-top" alt="...">
        </div>
    @endforeach
</div>


<script>
    $(document).on("click", ".browse", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });
</script>


@endsection
