@extends('master')

@section('title', 'Mahasiswa')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="col-sm-6">
            <h3 class="m-0">Daftar Mahasiswa</h3>
        </div>
    </div>

    <div class="card-body">
        <div style="max-width: 30%">
            <form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-4">
                <div class="form-group">
                    <label for="jurusan">Filter Jurusan:</label>
                    <select name="jurusan" id="jurusan" class="form-control" onchange="this.form.submit()">
                        <option value="all" {{ request('jurusan') == 'all' ? 'selected' : '' }}>Semua Jurusan</option>
                        @foreach ($jurusan as $j)
                            <option value="{{ $j->kode_jurusan }}" {{ request('jurusan') == $j->kode_jurusan ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No.</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>Jurusan</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=>$item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><a href="{{ route('mahasiswa.kegiatan', $item->nim) }}">{{ $item->nim }}</a></td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->prodi->nama_prodi }}</td>
                    <td>{{ $item->jurusan->nama_jurusan }}</td>
                    <td>{{ $status[$item->nim] }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
