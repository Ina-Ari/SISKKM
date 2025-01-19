<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPRAJA PNB | LOGIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

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
    </div>
    <div class="card-body">
      <p class="login-box-msg">Webpage Mahasiswa PNB</p>
      <form action="{{ route('loggedinmhs') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NIM" name="nim">
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
        <div class="row">
          <div class="col-8">
            <label for="remember">
              <a href="{{ route('emailSubmit') }}">Ganti Password?</a>
            </label>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
      @if(session('gagal'))
        <p class="text-danger">{{ session('gagal') }}</p>
      @endif
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>