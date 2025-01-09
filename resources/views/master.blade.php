<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @include('partial.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('partial.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('partial.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
    @include('partial.script')
</body>
</html>
