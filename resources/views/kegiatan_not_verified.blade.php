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
                    <button id="btnVerifSelected" type="button" class="btn btn-sm btn-primary">
                        <i class="fas fa-check"></i> Verif
                    </button>
                    <button id="btnVerifAll" type="button" class="btn btn-sm"
                        style="background: #56ab2f; color: white; border: none; padding: 5px 15px; border-radius: 5px;">
                        <i class="fas fa-check-double"></i> Verif All
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Status Sertifikat</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $data)
                            <tr>
                                <td>{{ $data->nim }}</td>
                                <td>{{ $data->nama_kegiatan }}</td>
                                <td>{{ $data->tanggal_kegiatan }}</td>
                                <td>
                                    <span class="badge badge-danger">Belum Terverifikasi</span>
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