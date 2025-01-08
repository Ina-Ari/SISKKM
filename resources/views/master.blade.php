<<<<<<< HEAD
  <!DOCTYPE html>
=======
<!DOCTYPE html>
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
<html lang="en">
<head>
    <title>@yield('title')</title>
    @include('partial.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<<<<<<< HEAD
  {{-- <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Navbar -->
  @include('partial.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('partial.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>

  <!-- /.content-wrapper -->
  {{-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer> --}}

  <!-- Control Sidebar -->
  {{-- <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside> --}}
  <!-- /.control-sidebar -->
=======
  <!-- Navbar -->
  @include('partial.navbar')
  <!-- /.navbar -->
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<<<<<<< HEAD
=======
  <!-- Sidebar-->
  @include('partial.sidebar')

  <!-- Content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
</div>

<!-- Script -->
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
    @include('partial.script')
</body>
</html>
