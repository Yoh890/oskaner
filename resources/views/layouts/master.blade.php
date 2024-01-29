<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title id="pageTitle">Halaman Admin - Skanamber</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/fontawesome-free/css/all.min.css'); }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css');}}">
  <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css');}}">
  <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css');}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/adminlte.min.css');}}">
  <!-- Logo Kecil disebelah Title -->
  <link rel="icon" href="img/SMK6.png" type="image/png">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Beranda</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://wa.me/62881026956146" target="_blank" class="nav-link">Bantuan</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> --}}

      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ URL::asset('adminlte/dist/img/user1-128x128.jpg');}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Reza
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Assalamu'alaikum</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ URL::asset('adminlte/dist/img/user8-128x128.jpg');}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Farhan
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Assalamu'alaikum</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ URL::asset('adminlte/dist/img/user3-128x128.jpg');}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Fizi
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Assalamu'alaikum</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/SMK6.png');}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E - KESISWAAN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('adminlte/dist/img/user2-160x160.jpg');}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @php
      $currentRoute = \Request::route()->getName();
      @endphp

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

{{-- Pengguna --}}
          @if (in_array(auth()->user()->level, ['admin']))
              <li class="nav-item">
                <a href="{{ route('pengguna') }}" class="nav-link {{ $currentRoute === 'pengguna' ? 'active' : '' }}">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
              @endif

{{-- Laporan Pelanggaran --}}
          @if (in_array(auth()->user()->level, ['admin', 'bk', 'osis', 'waka']))
              <li class="nav-item">
                <a href="{{ route('lap') }}" class="nav-link {{ $currentRoute === 'lap' ? 'active' : '' }}">
                  <i class="fa fa-user-times nav-icon"></i>
                  <p>Laporan Pelanggaran</p>
                </a>
              </li>
              @endif

{{-- Laporan Kegiatan OSIS --}}
              @if (in_array(auth()->user()->level, ['admin', 'waka', 'osis']))
                        <li class="nav-item">
                            <a href="{{ route('keg') }}" class="nav-link {{ $currentRoute === 'keg' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-bookmark"></i>
                              <p>Laporan Kegiatan OSIS</p>
                            </a>
                          </li>
                    @endif

{{-- Laporan Ekstrakurikuler --}}
                    @if (in_array(auth()->user()->level, ['admin', 'waka', 'osis','ekskul']))
              <li class="nav-item">
                <a href="{{ route('ekskul') }}" class="nav-link {{ $currentRoute === 'ekskul' ? 'active' : '' }}">
                    <i class="nav-icon fa fa-flag"></i>
                  <p>Laporan Ekstrakurikuler</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('ekstra') }}" class="nav-link {{ $currentRoute === 'ekstra' ? 'active' : '' }}">
                    <i class="nav-icon fa fa-flag"></i>
                  <p>Data Ekstrakurikuler</p>
                </a>
              </li>
              @endif

{{-- Kesiswaan --}}
              @if (in_array(auth()->user()->level, ['admin', 'bk', 'osis', 'waka']))
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>
                    Kesiswaan
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('kel') }}" class="nav-link {{ $currentRoute === 'kel' ? 'active' : '' }}">
                        <p>Kelas</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('sis') }}" class="nav-link {{ $currentRoute === 'sis' ? 'active' : '' }}">
                        <p>Siswa</p>
                      </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pel') }}" class="nav-link {{ $currentRoute === 'pel' ? 'active' : '' }}">
                          <p>Pelanggaran</p>
                        </a>
                      </li>

                    @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
                    <li class="nav-item">
                      <a href="{{ route('prestasi') }}" class="nav-link {{ $currentRoute === 'prestasi' ? 'active' : '' }}">
                        <p>Prestasi</p>
                      </a>
                    </li>
                    @endif
                </ul>
              </li>
              @endif

{{-- Rekap Data --}}
                    @if (in_array(auth()->user()->level, ['admin', 'waka','bk']))
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-book"></i>
                  <p>Rekap Data</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('rekap_pelanggaran') }}" class="nav-link {{ $currentRoute === 'rekap_pelanggaran' ? 'active' : '' }}">
                      <p>10 Siswa Point Terbanyak</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('rekap_laporan') }}" class="nav-link {{ $currentRoute === 'rekap_laporan' ? 'active' : '' }}">
                      <p>Laporan Pelanggaran</p>
                    </a>
                  </li>
                  @if (in_array(auth()->user()->level, ['admin', 'waka']))
                  <li class="nav-item">
                    <a href="{{ route('rekap_pelatih') }}" class="nav-link {{ $currentRoute === 'rekap_pelatih' ? 'active' : '' }}">
                      <p>Absen Pelatih</p>
                    </a>
                  </li>
                  @endif
              </ul>
              </li>
              @endif




              <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">

                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    LogOut
                  </p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
@yield('content')
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2024 <a href="https://instagram.com/yohanalilham" target="_blank">Joo</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::asset('adminlte/plugins/jquery/jquery.min.js');}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js');}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ URL::asset('adminlte/plugins/datatables/jquery.dataTables.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/jszip/jszip.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/pdfmake/pdfmake.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/pdfmake/vfs_fonts.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js');}}"></script>
<script src="{{ URL::asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js');}}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('adminlte/dist/js/adminlte.min.js');}}"></script>
<!-- AdminLTE for demo purposes -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var cardTitle = document.querySelector('.card-title').textContent;
      document.getElementById('pageTitle').textContent = cardTitle + ' - Skanamber';
    });
  </script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
    $('#rekap').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#rekap_wrapper .col-md-6:eq(0)');
    $('#rekap2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#rekap2_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
