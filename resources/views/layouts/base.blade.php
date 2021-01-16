<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('template/img/logo/logo.png') }}" rel="icon">
  <title>ModernFarms - @yield('title')</title> 
  <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
  {{--  sweet-alert  --}}
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('sweet-alert-master/pathto/css/sweetalert.css')}}"> --}}

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="{{ asset('template/img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">ModernFarms</div>
      </a>
      <hr class="sidebar-divider my-0">
      @if (Auth::user()->level == 'petani')
        <li class="nav-item">
          <a class="nav-link" href="{{ route ('petani.beranda.index')}}">
            <i class="fas fa-fw fa-columns"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Monitoring
        </div>
        <li class="nav-item">
          <a class="nav-link" href="{{ route ('petani.monitoring.index')}}">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Monitoring</span>
          </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Kendali
        </div>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('petani.kendali.index') }}">
            </i><i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Kendali</span>
            </a>
        </li>
      @else
        <li class="nav-item">
        <a class="nav-link" href="{{route ('admin.beranda.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Monitoring
        </div>
        <li class="nav-item">
        <a class="nav-link" href="{{route ('admin.monitoring.index')}}">
            <i class="fas fa-fw fa-columns"></i>
            <span>Monitoring</span>
          </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
          Manajemen
        </div>
        <li class="nav-item">
        <a class="nav-link" href="{{route ('admin.manajemen_user.index')}}">
            <i class="fas fa-fw fa-columns"></i>
            <span>Manajemen User</span>
          </a>
        </li>
      @endif
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            
           
           
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{ asset('template/img/boy.png') }}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">{{ auth()->user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              @if (Auth::user()->level == 'admin')
              <a class="dropdown-item" href="{{route('admin.profil.index')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                @else
                <a class="dropdown-item" href="{{route('petani.profil.index')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ __('Logout') }}
                </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        @yield('content')
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; 2020 - developed by
              <b><a href="#" target="_blank">Nur Azura Al-fahira</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('template/js/ruang-admin.min.js') }}"></script>
  <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
   {{--  sweet-alert  --}}
  {{-- <script src="{{asset('/js/sweetalert.min.js')}}"></script> --}}
  {{-- @include('sweet::alert') --}}

  <!-- Page level custom scripts -->
  @stack('script')
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>
