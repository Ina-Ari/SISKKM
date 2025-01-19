@extends('mhs.masterMhs')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
        <div class="container-fluid">
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Selamat Datang di SIPRAJA!</h5>
            SIPRAJA (Sistem Informasi Perekapan Aktivitas dan Jejak Mahasiswa) adalah platform yang membantu mahasiswa merekap poin SKKM dengan mudah. <br>Jangan lewatkan kesempatan untuk terus aktif, karena poin yang kamu kumpulkan adalah cerminan dari usahamu dalam mengembangkan diri!
          </div>

        </div>
        <div class="col-sm-6">
            <h2 class="m-0">Selamat Datang, {{ $mahasiswa->nama }}</h2>
        </div>
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-3 col-md-6 col-12 mb-4">
                      <!-- small box -->
                      <div class="small-box" style="background-color: #0056b3; color: white;">
                          <div class="inner">
                              <h3>{{ $totalKegiatan }}</h3>
                              <p>Kegiatan Diikuti</p>
                          </div>
                          <div class="icon">
                              <i class="fas fa-users"></i>
                          </div>
                          
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box" style="background-color: #28a745; color: white;">
                          <div class="inner">
                              <h3>{{ $totalVerifTrue }}</h3>
                              <p>Kegiatan Terverifikasi</p>
                          </div>
                          <div class="icon">
                              <i class="fas fa-check-circle"></i>
                          </div>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box" style="background-color: #ffc107; color: black;">
                          <div class="inner">
                              <h3>{{ $totalVerifFalse }}</h3>
                              <p>Kegiatan Belum Terverifikasi</p>
                          </div>
                          <div class="icon">
                              <i class="fas fa-exclamation-circle"></i>
                          </div>
                          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                      </div>
                  </div>
                </div>
              </div>

              {{-- Detail Kegiatan --}}
              <div class="col-sm-6">
                <h2 class="m-0">Detail Kegiatan</h2>
              </div>
              <div class="container-fluid" style="margin-top:10px;">
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                      <div class="info-box" style="background-color: #f0f8ff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; height: 90px;">
                          <span class="info-box-icon" style="background-color: #0056b3; color: white; border-radius: 50%; padding: 10px; font-size: 25px;">
                              <i class="fas fa-trophy"></i> <!-- Elegant trophy icon -->
                          </span>
    
                          <div class="info-box-content" style="padding-left: 15px; padding-right: 15px;">
                              <span class="info-box-text" style="font-size: 0.9rem; font-weight: bold; color: #0056b3; word-wrap: break-word;">Total Poin</span>
                            @php
                                $totalPoin = $totalPoin ?? 0; // Use the passed value or default to 0
                                 // Default color: red (low points)

                                if ($totalPoin >= 20) {
                                    $textColor = '#ffc107'; // Green (high points)
                                } elseif ($totalPoin <= 10) {
                                    $textColor = '#dc3545'; // Yellow (medium points)
                                } elseif ($totalPoin >=28) {
                                    $textColor = '#28a745';
                                }
                            @endphp
                              <span class="info-box-number" style="font-size: 1.3rem; font-weight: bold; color: {{ $textColor }};">
                                {{ $totalPoin }} / 
                                    @if ($jenjang_pendidikan === 'D3')
                                        24
                                    @elseif ($jenjang_pendidikan === 'D4')
                                        28
                                    @else
                                        -
                                    @endif
                                    Poin Terkumpul
                              </span>
                              <div class="progress" style="height: 6px; background-color: #e9ecef; margin-top: 5px;">
                                  <div class="progress-bar" style="width: {{ min(100, ($totalPoin / 28) * 100) }}%; background-color: {{ $textColor }};"></div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-3 col-sm-6" >
                    <div class="info-box" style="background-color: #f0f8ff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; height: 90px;">
                        <span class="info-box-icon" style="background-color: #0056b3; color: white; border-radius: 50%; padding: 10px; font-size: 25px;">
                            <i class="fas fa-plus"></i> <!-- Elegant trophy icon -->
                        </span>
  
                        <div class="info-box-content" style="padding-left: 15px; padding-right: 15px;">
                            <span class="info-box-text" style="font-size: 1rem; font-weight: bold; color: #0056b3; word-wrap: break-word;">Ajukan Kegiatan</span>
                            {{-- <span class="info-box-number" style="font-size: 1.3rem; font-weight: bold; color: #28a745;">Hehee</span> --}}
                            <button type="button" class="btn btn-block btn-outline-primary btn-sm" data-toggle="modal" data-target="#formKegiatanModal" title="Tambahkan Kegiatan">Tambah Kegiatan</button>
                        </div>
                    </div>
                </div>
                  </div>

                  {{-- Table --}}
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
              
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th> 
                            <th>Jumlah Poin</th>
                            <th>Posisi Kegiatan</th> 
                            <th>Tingkatan Kegiatan</th>
                            <th>Status Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatan as $item)
                            <tr>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->poin }}</td>
                                <td>{{ $item->nama_posisi }}</td>
                                <td>{{ $item->tingkat_kegiatan }}</td>
                                <td>
                                    @if ($item->verif === 'True' || $item->verif == 1)
                                    <span class="badge badge-success">Terverifikasi</span>
                                    @elseif ($item->verif === '0' || $item->verif == 0)
                                        <span class="badge badge-danger">Belum Terverifikasi</span>
                                    @else
                                        <span class="badge badge-danger">Belum Terverifikasi</span>
                                    @endif
                                
                              </td>
                              <td style="text-align: center; vertical-align: middle;">
                                <button title="Lihat Detail" style="border:none; background-color:transparent; margin-right: 10px;" type="button" class="fas fa-eye" data-toggle="modal" data-target="#DetailKegiatan{{ $item->id_kegiatan }}">
                                <button title="Edit Kegiatan" style="border:none; background-color:transparent;" type="button" class="fas fa-edit" data-toggle="modal" data-target="#formEditKegiatan{{ $item->id_kegiatan }}">
                              </td>
                            </tr>

                            {{-- Modal Detail Kegiatan --}}
                            <div class="modal fade" id="DetailKegiatan{{ $item->id_kegiatan }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Kegiatan</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Kegiatan</label>
                                                <input class="form-control" value="{{ $item->nama_kegiatan }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Kegiatan</label>
                                                <input class="form-control" value="{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->translatedFormat('d F Y') }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Posisi</label>
                                                <input class="form-control" value="{{ $item->nama_posisi }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Tingkat Kegiatan</label>
                                                <input class="form-control" value="{{ $item->tingkat_kegiatan }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kegiatan</label>
                                                <input class="form-control" value="{{ $item->jenisKegiatan->jenis_kegiatan ?? '' }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Poin</label>
                                                <input class="form-control" value="{{ $item->poin }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Status Sertifikat</label>
                                                <input class="form-control" value="{{ $item->verif === 'True' ? 'Terverifikasi' : 'Belum Terverifikasi' }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Sertifikat</label>
                                                <div class="text-center mt-3">
                                                    <img src="{{ asset($item->sertifikat) }}" alt="Tidak Dapat Menampilkan Sertifikat" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            
                        <!-- Modal Edit Kegiatan -->
                        <div class="modal fade" id="formEditKegiatan{{ $item->id_kegiatan }}" tabindex="-1" aria-labelledby="formEditKegiatanLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('form.updateKegiatan', $item->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="formEditKegiatanLabel">Edit Sertifikat</h3>
                                        </div>
                                        <div class="modal-body">

                                            <!-- Input Hidden: Nim -->
                                            <input type="hidden" name="nim" value="{{ session('nim') }}">
                                            <input type="hidden" name="verifsertif" value="{{ old('verifsertif', $item->verifsertif) }}">


                                            <!-- Nama Kegiatan -->
                                            <div class="mb-3">
                                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                                value="{{ $item->nama_kegiatan }}" required>                    
                                            </div>
                                            
                                            <!-- Tanggal Kegiatan -->
                                            <div class="mb-3">
                                                <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                                <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" 
                                                    value="{{ old('tanggal_kegiatan', $item->tanggal_kegiatan) }}" required>
                                            </div>

                                            <!-- Posisi -->
                                            <div class="mb-3">
                                                <label for="id_posisi" class="form-label">Posisi</label>
                                                <select name="id_posisi" id="id_posisi" class="form-control" required>
                                                    <option value="">-- Pilih Posisi --</option>
                                                    @foreach ($posisi as $pos)
                                                        <option value="{{ $pos->id_posisi }}" 
                                                            {{ $pos->id_posisi == $item->id_posisi ? 'selected' : '' }}>
                                                            {{ $pos->nama_posisi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Tingkat Kegiatan -->
                                            <div class="mb-3">
                                                <label for="idtingkat_kegiatan" class="form-label">Tingkat Kegiatan</label>
                                                <select name="idtingkat_kegiatan" id="idtingkat_kegiatan" class="form-control" required>
                                                    <option value="">-- Pilih Tingkat Kegiatan --</option>
                                                    @foreach ($tingkatKegiatan as $tk)
                                                        <option value="{{ $tk->idtingkat_kegiatan }}" 
                                                            {{ $tk->idtingkat_kegiatan == $item->idtingkat_kegiatan ? 'selected' : '' }}>
                                                            {{ $tk->tingkat_kegiatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Jenis Kegiatan -->
                                            <div class="mb-3">
                                                <label for="idjenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                                                <select name="idjenis_kegiatan" id="idjenis_kegiatan" class="form-control" required>
                                                    <option value="">-- Pilih Jenis Kegiatan --</option>
                                                    @foreach ($jenisKegiatan as $jk)
                                                        <option value="{{ $jk->idjenis_kegiatan }}" 
                                                            {{ $jk->idjenis_kegiatan == $item->idjenis_kegiatan ? 'selected' : '' }}>
                                                            {{ $jk->jenis_kegiatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Sertifikat -->
                                            <div class="mb-3">
                                                <label for="sertifikat" class="form-label">Upload Sertifikat</label><br/>
                                                @if ($item->sertifikat)
                                                    <img src="{{ asset($item->sertifikat) }}" alt="Sertifikat" class="img-fluid mb-2" 
                                                        style="max-width: 100%; height: auto;">
                                                @endif
                                                <input type="file" id="sertifikat" name="sertifikat" class="form-control-file" 
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('sertifikat')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        
                            <!-- Modal Add Kegiatan -->
                            <div class="modal fade" id="formKegiatanModal" tabindex="-1" role="dialog" aria-labelledby="formKegiatanLabel" aria-hidden="true">
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
                        
                                                <!-- Nim -->
                                                <div class="form-group">
                                                    <input type="text" id="Nim" name="Nim" class="form-control" value="{{$nim}}" placeholder="Nim" required disabled hidden>
                                                    <input type="hidden" name="Nim" value="{{$nim}}">
                                                @error('Nim')
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
                            </div>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </section>

@endsection
