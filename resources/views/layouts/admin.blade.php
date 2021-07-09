<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- include summernote css/js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- datepicker --}}
    <link rel="stylesheet" href="/css/datepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
      .navbar{
        z-index: 1;
        top:0;
        display:block;
        position: fixed;
        width: 100%;
      }
      .border-left-primary {
        border-left: 0.25rem solid #ff7ec9 !important; /*Warna untuk sisi kiri di semua menu dashboard back end*/
      }
    </style>
  </head>
  <body>
      <input type="checkbox" id="check">
      <nav class="navbar navbar-expand-lg navbar-dark bg-secondary" {{--style="background: #ff7ec9"--}}>
        <div class="container">
        <a href="/dashboard" class="navbar-brand">
          <img src = {{ asset('assets/img/POSYANDU.png') }}{{--"assets/img/POSYANDU.png"--}} alt="" style="height: 50px;" class="img-fluid"><span>POSYANDU</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
                <label class="nav-link" for="check">
                    <i class="fas fa-bars" id="sidebar_btn"></i>
                </label>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white"><i class="fas fa-user" style="color: white"></i>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <!--<a class="dropdown-item" href="{{ route('logout') }}">Profil</a>-->
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Log Out') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                </div>
            </li>
          </ul>
        </div>
      </div>
      </nav>

    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <!-- <img src="https://badoystudio.com/wp-content/uploads/2018/05/usericon.png" class="mobile_profile_image" alt=""> -->
        <p style="font-size: 16px; color: white">Menu</p><i class="fa fa-list nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
        <a href="/dashboard"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
        <a href="/gallery"><i class="fas fa-image"></i><span>Galeri</span></a>
        <a href="/balita"><i class="fas fa-baby-carriage"></i><span>Data Balita</span></a>
        <a href="/orangtua"><i class="fas fa-baby-carriage"></i><span>Data Orang Tua</span></a>
        <a href="/penimbangan"><i class="fas fa-balance-scale"></i><span>Data Penimbangan</span></a>
        <a class="dropdown-btn"><i class="fas fa-university"></i><span>Data Keuangan</span></a>
        <div class="dropdown-container">
          <a href="/kasmasuk"><i class="fas fa-plus-square"></i><span>Kas Masuk</span></a>
          <a href="/kaskeluar"><i class="fas fa-minus-square"></i><span>Kas Keluar </span></a>
          <a href="/keuangan"><i class="fas fa-sort-amount-up"></i><span>Rekapitulasi</span></a>
          {{-- <a href="#">Link 1</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a> --}}
        </div>
        <a href="/blog"><i class="fas fa-blog"></i><span>Data Jadwal Pelayanan</span></a>
        <a href="/akun"><i class="fas fa-user"></i><span>Data Kader</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar bg-dark">
      {{-- <div class="profile_info">
        <img src="https://badoystudio.com/wp-content/uploads/2018/05/usericon.png" class="profile_image" alt="">
        <h4>Admin</h4>
      </div> --}}
      <a href="/dashboard"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
      <a href="/gallery"><i class="fas fa-image"></i><span>Galeri</span></a>
      <a href="/balita"><i class="fas fa-baby-carriage"></i><span>Data Balita</span></a>
      <a href="/orangtua"><i class="fas fa-baby-carriage"></i><span>Data Orang Tua</span></a>
      <a href="/penimbangan"><i class="fas fa-balance-scale"></i><span>Data Penimbangan</span></a>
      <a class="dropdown-btn" style="cursor: pointer;"><i class="fas fa-university"></i><span>Data Keuangan</span></a>
      <div class="dropdown-container">
        <a href="/kasmasuk"><i class="fas fa-plus-square"></i><span>Kas Masuk</span></a>
        <a href="/kaskeluar"><i class="fas fa-minus-square"></i><span>Kas Keluar </span></a>
        <a href="/keuangan"><i class="fas fa-sort-amount-up"></i><span>Rekapitulasi</span></a>
        {{-- <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a> --}}
      </div>
      <a href="/blog"><i class="fas fa-calendar"></i><span>Data Jadwal Pelayanan</span></a>
      <a href="/akun"><i class="fas fa-user"></i><span>Kader</span></a>
   
    </div>
    <!--sidebar end-->

    <div class="content">
        @yield('content')
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  
   <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
   <script type="text/javascript">
 
   $('#summernote').summernote({
       height: 150
   });
   /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
      this.classList.toggle("active-side");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
      } else {
      dropdownContent.style.display = "block";
      }
      });
      }
   </script>
   <script>
        $('.dateselect').datepicker({
        format: 'yyyy-mm-dd',
        // startDate: '-3d'
    });
   </script>
   @yield('footer')
  </body>
</html>
                           