@extends('master')

@section('title', 'Kegiatan Belum Terverifikasi')

@section('content')
<form id="formVerify" method="POST" action="{{ route('kegiatan.verify_selected') }}">
    @csrf
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="col-sm-6">
            <h3 class="m-0">Kegiatan Belum Diverifikasi</h3>
        </div>
        <div class="col-sm-6 text-right">
            <button id="btnVerifSelected" class="btn btn-primary btn-sm">Verif</button>
            <button id="btnVerifAll" class="btn btn-success btn-sm">Verif All</button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Status Sertifikat</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan as $key=>$data)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->nama_kegiatan }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
                        <td>
                            @if ($data->verifsertif === 'True')
                                Terverifikasi
                            @else
                                Belum Terverifikasi
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="selected_kegiatan[]" value="{{ $data->id_kegiatan }}">
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $data->id_kegiatan }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('poin.update', $data->id_kegiatan) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Kegiatan</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Posisi</label>
                                        <select name="id_posisi" class="form-control">
                                            @foreach ($posisi as $pos)
                                                <option value="{{ $pos->id_posisi }}" {{ $data->id_posisi == $pos->id_posisi ? 'selected' : '' }}>
                                                    {{ $pos->nama_posisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label>Tingkat Kegiatan</label>
                                        <select name="idtingkat_kegiatan" class="form-control">
                                            @foreach ($tingkatKegiatan as $tk)
                                                <option value="{{ $tk->idtingkat_kegiatan }}" {{ $data->idtingkat_kegiatan == $tk->idtingkat_kegiatan ? 'selected' : '' }}>
                                                    {{ $tk->tingkat_kegiatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label>Jenis Kegiatan</label>
                                        <select name="idjenis_kegiatan" class="form-control">
                                            @foreach ($jenisKegiatan as $jk)
                                                <option value="{{ $jk->idjenis_kegiatan }}" {{ $data->idjenis_kegiatan == $jk->idjenis_kegiatan ? 'selected' : '' }}>
                                                    {{ $jk->jenis_kegiatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-group">
                                            <label>Poin Kegiatan</label>
                                            <input type="text" name="poin" class="form-control" value="{{ $data->poin }}" required>
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
    </div>
</div>

@endsection
