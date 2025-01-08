@extends('master')

@section('title', 'Poin Kegiatan')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="col-sm-6">
            <h3 class="m-0">Poin Kegiatan</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">+ New</button>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No.</th>
            <th>Posisi</th>
            <th>Tingkat Kegiatan</th>
            <th>Jenis Kegiatan</th>
            <th>Poin Kegiatan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key=>$item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->posisi->nama_posisi}}</td>
                    <td>{{ $item->tingkatKegiatan->tingkat_kegiatan}}</td>
                    <td>{{ $item->jenisKegiatan->jenis_kegiatan}}</td>
                    <td>{{ $item->poin }}</td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $item->id_poin }}">Edit</button>
                        <form action="{{ route('poin.destroy', $item->id_poin) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $item->id_poin }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('poin.update', $item->id_poin) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Poin Kegiatan</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <label>Posisi</label>
                                    <select name="id_posisi" class="form-control">
<<<<<<< HEAD
                                        @foreach ($posisi as $posisi)
                                            <option value="{{ $posisi->id_posisi }}" {{ $item->id_posisi == $posisi->id_posisi ? 'selected' : '' }}>
                                                {{ $posisi->nama_posisi }}
=======
                                        @foreach ($posisi as $pos)
                                            <option value="{{ $pos->id_posisi }}" {{ $item->id_posisi == $pos->id_posisi ? 'selected' : '' }}>
                                                {{ $pos->nama_posisi }}
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
                                            </option>
                                        @endforeach
                                    </select>
                                    <label>Tingkat Kegiatan</label>
                                    <select name="idtingkat_kegiatan" class="form-control">
<<<<<<< HEAD
                                        @foreach ($tingkatKegiatan as $tingkatKegiatan)
                                            <option value="{{ $tingkatKegiatan->idtingkat_kegiatan }}" {{ $item->idtingkat_kegiatan == $tingkatKegiatan->idtingkat_kegiatan ? 'selected' : '' }}>
                                                {{ $tingkatKegiatan->tingkat_kegiatan }}
=======
                                        @foreach ($tingkatKegiatan as $tk)
                                            <option value="{{ $tk->idtingkat_kegiatan }}" {{ $item->idtingkat_kegiatan == $tk->idtingkat_kegiatan ? 'selected' : '' }}>
                                                {{ $tk->tingkat_kegiatan }}
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
                                            </option>
                                        @endforeach
                                    </select>
                                    <label>Jenis Kegiatan</label>
                                    <select name="idjenis_kegiatan" class="form-control">
<<<<<<< HEAD
                                        @foreach ($jenisKegiatan as $jenisKegiatan)
                                            <option value="{{ $jenisKegiatan->idjenis_kegiatan }}" {{ $item->idjenis_kegiatan == $jenisKegiatan->idjenis_kegiatan ? 'selected' : '' }}>
                                                {{ $jenisKegiatan->jenis_kegiatan }}
=======
                                        @foreach ($jenisKegiatan as $jk)
                                            <option value="{{ $jk->idjenis_kegiatan }}" {{ $item->idjenis_kegiatan == $jk->idjenis_kegiatan ? 'selected' : '' }}>
                                                {{ $jk->jenis_kegiatan }}
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label>Poin Kegiatan</label>
                                        <input type="text" name="poin" class="form-control" value="{{ $item->poin }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
      </table>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
<<<<<<< HEAD
                    <form action="{{ route('tingkatKegiatan.store') }}" method="POST">
=======
                    <form action="{{ route('poin.store') }}" method="POST">
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Poin Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
<<<<<<< HEAD
                            <div class="form-group">
                                <label>Poin Kegiatan</label>
                                <input type="text" name="tingkat_kegiatan" class="form-control" required>
=======
                            <label>Posisi</label>
                            <select name="id_posisi" class="form-control">
                                @foreach ($posisi as $posisi)
                                    <option value="{{ $posisi->id_posisi }}">{{ $posisi->nama_posisi }}</option>
                                @endforeach
                            </select>
                            <label>Tingkat Kegiatan</label>
                            <select name="idtingkat_kegiatan" class="form-control">
                                @foreach ($tingkatKegiatan as $tingkatKegiatan)
                                    <option value="{{ $tingkatKegiatan->idtingkat_kegiatan }}">{{ $tingkatKegiatan->tingkat_kegiatan }}</option>
                                @endforeach
                            </select>
                            <label>Jenis Kegiatan</label>
                            <select name="idjenis_kegiatan" class="form-control">
                                @foreach ($jenisKegiatan as $jenisKegiatan)
                                    <option value="{{ $jenisKegiatan->idjenis_kegiatan }}">{{ $jenisKegiatan->jenis_kegiatan }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label>Poin Kegiatan</label>
                                <input type="text" name="poin" class="form-control" required>
>>>>>>> 246e45263fa99c243947aaa12f95fa4833236f4a
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
