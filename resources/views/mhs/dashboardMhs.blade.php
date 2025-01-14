@extends('mhs.masterMhs')

@section('title', 'Dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
            <!-- /.col -->
          </div><!-- /.row -->
        </div>
        <div class="col-sm-6">
            <h2 class="m-0">Selamat Datang, {{ session('nama') }}</h2>
        </div><!-- /.container-fluid -->
    </div>
     <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ session('totalKegiatan', 0) }}</h3>
                  <p>Kegiatan Diikuti</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ session('totalVerifTrue', 0) }}</h3>
                  <p>Kegiatan Terverifikasi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ session('totalVerifFalse', 0) }}</h3>
                  <p>Kegiatan Belum Terverifikasi</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>10/28</h3>
                  <p>Poin Terkumpul</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div><!-- /.container-fluid -->
        </div>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>Nama Kegiatan</th>
                  <th>Tanggal Kegiatan</th>
                  <th>Jumlah Poin</th>
                  <th>Posisi Kegiatan</th>
                  <th>Tingkatan Kegiatan</th>
                  <th>Status Verifikasi</th>
              </tr>
          </thead>
          <tbody>
              @foreach (session('kegiatan', []) as $item)
                  <tr>
                      <td>{{ $item->nama_kegiatan }}</td>
                      <td>{{ $item->tanggal_kegiatan }}</td>
                      <td>{{ $item->poin }}</td>
                      <td>{{ $item->nama_posisi }}</td>
                      <td>{{ $item->tingkat_kegiatan }}</td>
                      <td>
                        @if ($item->verifsertif === 'true')
                            Terverifikasi
                        @else
                            Belum Terverifikasi
                        @endif
                    </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      </section>
      <!-- /.content -->
@endsection
