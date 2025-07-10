@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h2>Dashboard Reimburse</h2>
<a href="{{ url('/admin/create') }}" class="btn btn-success mb-3">Tambah Data</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>NRP</th>
            <th>Jabatan</th>
            <th>Jenis Sertifikat</th>
            <th>No Sertifikat</th>
            <th>Tanggal Pengajuan</th>
            <th>Status</th>
            <th>Tanggal Selesai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reimburses as $r)
        <tr>
            <td>{{ $r->nama }}</td>
            <td>{{ $r->nrp }}</td>
            <td>{{ $r->jabatan }}</td>
            <td>{{ $r->jenis_sertifikat }}</td>
            <td>{{ $r->no_sertifikat }}</td>
            <td>{{ $r->tanggal_pengajuan }}</td>
            <td>{{ $r->status }}</td>
            <td>{{ $r->tanggal_selesai }}</td>
            <td>
                <a href="{{ url('/admin/'.$r->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ url('/admin/'.$r->id) }}" method="post" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus data?')" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
