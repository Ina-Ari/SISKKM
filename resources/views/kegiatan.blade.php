@extends('master')

@section('title', 'Kegiatan Terverifikasi')

@section('content')
<form id="formCancel" method="POST" action="{{ route('kegiatan.cancel_selected') }}">
    @csrf
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="col-sm-6">
            <h3 class="m-0">Kegiatan Terverifikasi</h3>
        </div>
        <div class="col-sm-6 text-right">
            <button id="btnCancelSelected" class="btn btn-danger btn-sm">Cancel</button>
            <button id="btnCancelAll" class="btn btn-warning btn-sm">Cancel All</button>
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
                                <span>Terverifikasi</span>
                            @else
                                <span>Belum Terverifikasi</span>
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="checkbox" name="selected_kegiatan[]" value="{{ $data->id_kegiatan }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


