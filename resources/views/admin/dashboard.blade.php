@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h2>Dashboard Reimburse</h2>
<a href="{{ url('/admin/create') }}" class="btn btn-success mb-3">Tambah Data</a>

<form method="GET" action="{{ url('/admin') }}" class="mb-3">
    <div class="d-flex justify-content-between gap-2">
        <!-- Search Bar di kiri -->
        <input type="text" name="search" class="form-control" placeholder="Cari Nama, Jabatan, atau No Sertifikat..." value="{{ request('search') }}" style="max-width:220px;">
        <!-- Filter Status & Sort di kanan -->
        <div class="d-flex gap-2">
            <div class="btn-group">
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Status {{ request('status') ? ucfirst(request('status')) : 'All' }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/admin') }}">All</a></li>
                    <li><a class="dropdown-item" href="{{ url('/admin?status=On Review') }}">On Review</a></li>
                    <li><a class="dropdown-item" href="{{ url('/admin?status=Diajukan ke LND') }}">Diajukan ke LND</a></li>
                    <li><a class="dropdown-item" href="{{ url('/admin?status=Diajukan ke Akuntansi') }}">Diajukan ke Akuntansi</a></li>
                    <li><a class="dropdown-item" href="{{ url('/admin?status=Diajukan ke Treasury') }}">Diajukan ke Treasury</a></li>
                    <li><a class="dropdown-item" href="{{ url('/admin?status=Cleared') }}">Cleared</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(request('sort') && request('order'))
                        @if(request('sort') == 'nama' && request('order') == 'asc')
                            Nama (A-Z)
                        @elseif(request('sort') == 'nama' && request('order') == 'desc')
                            Nama (Z-A)
                        @elseif(request('sort') == 'tanggal_pengajuan' && request('order') == 'desc')
                            Tanggal Pengajuan (Terbaru)
                        @elseif(request('sort') == 'tanggal_pengajuan' && request('order') == 'asc')
                            Tanggal Pengajuan (Terlama)
                        @else
                            Default
                        @endif
                    @else
                        Default
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ url('/admin?' . http_build_query(array_merge(request()->except(['sort','order']), []))) }}">
                            Default
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/admin?' . http_build_query(array_merge(request()->except(['sort','order']), ['sort'=>'nama','order'=>'asc']))) }}">
                            Nama (A-Z)
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/admin?' . http_build_query(array_merge(request()->except(['sort','order']), ['sort'=>'nama','order'=>'desc']))) }}">
                            Nama (Z-A)
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/admin?' . http_build_query(array_merge(request()->except(['sort','order']), ['sort'=>'tanggal_pengajuan','order'=>'desc']))) }}">
                            Tanggal Pengajuan (Terbaru)
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/admin?' . http_build_query(array_merge(request()->except(['sort','order']), ['sort'=>'tanggal_pengajuan','order'=>'asc']))) }}">
                            Tanggal Pengajuan (Terlama)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</form>

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
            <td>
                <span class="badge {{ $r->status === 'Cleared' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $r->status }}
                </span>
            </td>
            <td>
                @if($r->cleared_date)
                    {{ \Carbon\Carbon::parse($r->cleared_date)->format('d F Y') }}
                @else
                    -
                @endif
            </td>
            <td>
                <a href="{{ url('/admin/'.$r->id.'/edit') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center justify-content-center" style="width:32px;height:32px;padding:0;">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ url('/admin/'.$r->id) }}" method="post" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus data?')" class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center" style="width:32px;height:32px;padding:0;">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-end my-4">
    {{ $reimburses->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@endsection