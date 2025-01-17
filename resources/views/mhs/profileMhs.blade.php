@extends('mhs.masterMhs')

@section('title', 'Profil Mahasiswa')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row" style="margin-top:10px;">
        <div class="col-lg-12">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="../../dist/img/user4-128x128.jpg"
                     alt="User profile picture">
              </div>

              <h2 class="text-center" style="font-size: 2rem; margin-top:5px;">{{ session('nama') }}</h2>

              <p class="text-muted text-center">{{ session('email') }}</p>
              <div class="card-footer" style="font-size: 1.5rem;">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h4><b>{{ session('nim') }}</b></h4>
                      <span class="description-text">NIM</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h4><b>{{ session('no_telepon') }}</b></h4>
                      <span class="description-text">Nomor Telepon</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h4><b>5A TRPL</b></h4>
                      <span class="description-text">Kelas</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <a href="#" class="btn btn-primary btn-block"><b>EDIT</b></a>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
            <h2 style="padding: 20px;"><b>Informasi Detail</b></h2>
              <div class="card-footer p-0">
                <ul class="nav flex-column" style="font-size: 1.4rem;">
                  <li class="nav-item nav-link">
                    Email <span class="float-right">{{ session('email') }}</span>
                  </li>
                  <li class="nav-item nav-link">
                    Jurusan <span class="float-right">{{ session('nama_jurusan') }}#</span>
                  </li>
                  <li class="nav-item nav-link">
                    Program Studi <span class="float-right">{{ session('nama_prodi') }} #</span>
                  </li>
                  <li class="nav-item nav-link">
                    Alamat <span class="float-right">Jalan Tegal Sari Gang Dahlia No.6, Banjar Biaung Asri, Kesiman Kertalangu, Denpasar Timur</span>
                  </li>
                  <li class="nav-item nav-link">
                    Status Poin <span class="float-right badge bg-primary">Memenuhi Syarat</span>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
    </div>
</section>
@endsection