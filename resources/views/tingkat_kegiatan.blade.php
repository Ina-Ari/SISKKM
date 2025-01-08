@extends('master')

@section('title', 'Tingkat Kegiatan')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="col-sm-6">
            <h3 class="m-0">Tingkat Kegiatan</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">+ New</button>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No.</th>
            <th>Tingkat Kegiatan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key=>$item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->tingkat_kegiatan }}</td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $item->idtingkat_kegiatan }}">Edit</button>
                        <form action="{{ route('tingkatKegiatan.destroy', $item->idtingkat_kegiatan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $item->idtingkat_kegiatan }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('tingkatKegiatan.update', $item->idtingkat_kegiatan) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Tingkat Kegiatan</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Tingkat Kegiatan</label>
                                        <input type="text" name="tingkat_kegiatan" class="form-control" value="{{ $item->tingkat_kegiatan }}" required>
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
                    <form action="{{ route('tingkatKegiatan.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Tingkat Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tingkat Kegiatan</label>
                                <input type="text" name="tingkat_kegiatan" class="form-control" required>
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
