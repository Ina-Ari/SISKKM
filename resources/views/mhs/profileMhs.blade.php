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

              <h2 class="text-center" style="font-size: 2rem; margin-top:5px;">{{ $mahasiswa->nama }}</h2>

              <p class="text-muted text-center">{{ $mahasiswa->email }}</p>
              <div class="card-footer" style="font-size: 1.5rem;">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h4><b>{{ $mahasiswa->nim }}</b></h4>
                      <span class="description-text">NIM</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h4><b>
                        @if(!empty($mahasiswa->no_telepon))
                          <p>{{ $mahasiswa->no_telepon }}</p>
                        @else
                            -
                        @endif
                      </b></h4>
                      <span class="description-text">Nomor Telepon</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h4><b>
                        @if(!empty($mahasiswa->kelas))
                          <p>{{ $mahasiswa->kelas }}</p>
                        @else
                            -
                        @endif
                      </b></h4>
                      <span class="description-text">Kelas</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#formEditMahasiswaModal"><b>EDIT</b></a>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
            <h2 style="padding: 20px;"><b>Informasi Detail</b></h2>
              <div class="card-footer p-0">
                <ul class="nav flex-column" style="font-size: 1.4rem;">
                  <li class="nav-item nav-link">
                    Email <span class="float-right">{{ $mahasiswa->email }}</span>
                  </li>
                  <li class="nav-item nav-link">
                    Jurusan <span class="float-right">{{ $mahasiswa->jurusan['nama_jurusan']}}</span>
                  </li>
                  <li class="nav-item nav-link">
                    Program Studi <span class="float-right">{{ $mahasiswa->jenjang_pendidikan}} {{ $mahasiswa->prodi['nama_prodi'] }}</span>
                  </li>
                  <li class="nav-item nav-link">
                    Alamat 
                    <span class="float-right">
                      @if(!empty($mahasiswa->alamat))
                        <p>{{ $mahasiswa->alamat }}</p>
                      @else
                          -
                      @endif
                    </span>
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

    {{-- <!-- Modal -->
    <div class="modal fade" id="formEditMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="formKegiatanLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="formKegiatanLabel">Form Kegiatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- Success message -->
                  @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  <!-- Error message -->
                  @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <!-- Form -->
                  <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 bg-white shadow-sm">
                      @csrf

                      <!-- Nama -->
                      <div class="form-group">
                          <input type="text" id="nama" name="nama" class="form-control" value="{{$nama}}" placeholder="Nama" required disabled hidden>
                          <input type="hidden" name="Nim" value="{{$nim}}">
                      @error('nama')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>
                      <!-- Nama Kegiatan -->
                      <div class="form-group">
                          <label for="Nama_kegiatan">Nama Kegiatan:</label>
                          <input type="text" id="Nama_kegiatan" name="Nama_kegiatan" class="form-control" 
                              value="{{ old('Nama_kegiatan') }}" placeholder="Masukkan nama kegiatan" required>
                          @error('Nama_kegiatan')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>

                      <!-- Tanggal Kegiatan -->
                      <div class="form-group">
                          <label for="tanggal_kegiatan">Tanggal Kegiatan:</label>
                          <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" class="form-control" 
                              value="{{ old('tanggal_kegiatan') }}" required>
                          @error('tanggal_kegiatan')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>

                      <!-- Dropdown Posisi -->
                      <div class="form-group">
                          <label for="id_posisi">Posisi:</label>
                          <select name="id_posisi" id="id_posisi" class="form-control" required>
                              <option value="">Pilih Posisi</option>
                              @foreach ($posisi as $item)
                                  <option value="{{ $item->id_posisi }}">{{ $item->nama_posisi }}</option>
                              @endforeach
                          </select>
                      </div>

                      <!-- Dropdown Tingkat Kegiatan -->
                      <div class="form-group">
                          <label for="idtingkat_kegiatan">Tingkat Kegiatan:</label>
                          <select name="idtingkat_kegiatan" id="idtingkat_kegiatan" class="form-control" required>
                              <option value="">Pilih Tingkat Kegiatan</option>
                              @foreach ($tingkatKegiatan as $item)
                                  <option value="{{ $item->idtingkat_kegiatan }}">{{ $item->tingkat_kegiatan }}</option>
                              @endforeach
                          </select>
                      </div>

                      <!-- Dropdown Jenis Kegiatan -->
                      <div class="form-group">
                          <label for="idjenis_kegiatan">Jenis Kegiatan:</label>
                          <select name="idjenis_kegiatan" id="idjenis_kegiatan" class="form-control" required>
                              <option value="">Pilih Jenis Kegiatan</option>
                              @foreach ($jenisKegiatan as $item)
                                  <option value="{{ $item->idjenis_kegiatan }}">{{ $item->jenis_kegiatan }}</option>
                              @endforeach
                          </select>
                      </div>

                      <!-- Sertifikat -->
                      <div class="form-group">
                          <label for="sertifikat">Upload Sertifikat:</label>
                          <input type="file" id="sertifikat" name="sertifikat" class="form-control-file" 
                              accept=".pdf,.jpg,.jpeg,.png" required>
                          @error('sertifikat')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>

                      <!-- Submit Button -->
                      <button type="submit" class="btn btn-primary btn-block">Simpan Kegiatan</button>
                  </form>
              </div>
          </div>
      </div>
  </div> --}}

@endsection