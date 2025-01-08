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
</div>
<!-- ./wrapper -->

<!-- jQuery -->
  <!-- Sidebar-->
  @include('partial.sidebar')

  <!-- Content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
</div>

<!-- Script -->
    @include('partial.script')
</body>
</html>
