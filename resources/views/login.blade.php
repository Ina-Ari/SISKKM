<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPRAJA PNB | ADMIN LOGIN</title>

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
  <style>
    body {
      background-image: url('image/foto_login.jpg'); /* Ganti dengan URL gambar Anda */
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 0;
      position: relative;
    }

    /* Overlay untuk background */
    .background-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6); /* Warna overlay */
      z-index: 1;
    }

    .login-box {
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.8); /* Opasitas putih */
        backdrop-filter: blur(10px); /* Efek blur */
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        border: 1px solid #dcdcdc;
    }

    .card-header {
      background: transparent;
      border-bottom: none;
    }

    .card-header h2, .card-header h4 {
      font-weight: bold;
      color: #004085;
    }

    .login-box-msg {
      font-size: 16px;
      font-weight: 500;
      color: #555;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    a {
      color: #007bff;
    }

    a:hover {
      color: #0056b3;
      text-decoration: underline;
      input:focus {
    border-color: #0056b3;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    button:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease-in-out;
    }

    }
  </style>
</head>
<body>
  <div class="background-overlay"></div>
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h2>SIPRAJA</h2>
        <h4>Politeknik Negeri Bali</h4>
      </a> 
    </div>
    <div class="card-body">
      <p class="login-box-msg"><b>Webpage Administrator</b></p>
      <form action="{{ route('loggedin') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span> 
            </div>
          </div>
        </div>
        <div class="row" align="center">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      @if(session('gagal'))
        <p class="text-danger">{{ session('gagal') }}</p>
      @endif
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
