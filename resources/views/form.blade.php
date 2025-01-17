<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kegiatan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


    <!-- Tombol untuk memunculkan modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formKegiatanModal">
        + Kegiatan
    </button>

    <!-- Modal -->
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
                            <label for="Nim">Nim:</label>
                            <input type="text" id="Nim" name="Nim" class="form-control" 
                                value="{{ old('Nim') }}" placeholder="Nim" required>
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
                                <small class="text-danger">{{ $message }}</ </small>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-block">Simpan Kegiatan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
