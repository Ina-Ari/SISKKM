<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPRAJA PNB | CHANGE PASSWORD</title>

  <link rel="icon" href="{{ asset('image/logo pnb.png') }}" type="image/png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="icon" href="#">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="../../index2.html" class="h1">
            <h2>SIPRAJA</h2>
            <h4>Politeknik Negeri Bali</h4>
          </a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Ubah Password Akun Mahasiswa</p>
          <form action="{{ route('updatePassword') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password Baru" name="password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Konfirmasi Password Baru" name="password_confirmation" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @if ($errors->has('password'))
              <div class="alert alert-danger">
                  {{ $errors->first('password') }}
              </div>
            @endif
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </div>
          </form>                
      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
