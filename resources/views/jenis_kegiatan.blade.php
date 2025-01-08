@extends('master')

@section('title', 'Jenis Kegiatan')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="col-sm-6">
            <h3 class="m-0">Jenis Kegiatan</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">+ New</button>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No.</th>
            <th>Jenis Kegiatan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key=>$item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->jenis_kegiatan }}</td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $item->idjenis_kegiatan }}">Edit</button>
                        <form action="{{ route('jenisKegiatan.destroy', $item->idjenis_kegiatan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editModal{{ $item->idjenis_kegiatan }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('jenisKegiatan.update', $item->idjenis_kegiatan) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Post</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Jenis Kegiatan</label>
                                        <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $item->jenis_kegiatan }}" required>
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
                    <form action="{{ route('jenisKegiatan.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Jenis Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Jenis Kegiatan</label>
                                <input type="text" name="jenis_kegiatan" class="form-control" required>
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
