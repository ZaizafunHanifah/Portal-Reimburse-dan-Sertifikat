@extends('layouts.app')

@section('dashboard-navbar')
@endsection

@section('title', 'Dashboard Sertifikat PSO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h2 class="mb-0">Sertifikat PSO</h2>
            <a href="{{ route('admin.sertifikat.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Tambah PSO
            </a>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.sertifikat.dashboard') }}" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-4 col-12">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama atau NRP"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 col-12">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            @foreach([
                                'Active' => 'Aktif',
                                'Will Expire' => 'Akan Kadaluarsa',
                                'Expired' => 'Kadaluarsa',
                            ] as $key => $label)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered dashboard-table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Jabatan</th>
                            <th>Jenis Sertifikat</th>
                            <th>No Sertifikat</th>
                            <th>Tgl Pengajuan</th>
                            <th>Tgl Terbit</th>
                            <th>Tgl Expired</th>
                            <th>Status Expire</th>
                            <th class="aksi-col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sertifikats as $item)
                            @php
                                $expiredDate = $item->expired ? \Carbon\Carbon::parse($item->expired) : null;
                                $today = \Carbon\Carbon::today();
                                $statusExpire = 'Not Available';

                                if ($expiredDate) {
                                    $willExpire = $expiredDate->copy()->subMonths(3);
                                    if ($today->gt($expiredDate)) {
                                        $statusExpire = 'Expired';
                                    } elseif ($today->gte($willExpire)) {
                                        $statusExpire = 'Will Expire';
                                    } else {
                                        $statusExpire = 'Active';
                                    }
                                }
                            @endphp
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nrp }}</td>
                                <td>{{ $item->jabatan ?? '-' }}</td>
                                <td>{{ $item->jenis_sertifikat ?? '-' }}</td>
                                <td>{{ $item->nomor_sertifikat ?? '-' }}</td>
                                <td>{{ $item->tanggal_pengajuan ? \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') : '-' }}</td>
                                <td>{{ $item->terbit ? \Carbon\Carbon::parse($item->terbit)->format('d M Y') : '-' }}</td>
                                <td>{{ $item->expired ? \Carbon\Carbon::parse($item->expired)->format('d M Y') : '-' }}</td>
                                <td>
                                    @switch($statusExpire)
                                        @case('Active')
                                            <span class="badge bg-success">Aktif</span>
                                            @break
                                        @case('Will Expire')
                                            <span class="badge bg-warning text-dark">Akan Kadaluarsa</span>
                                            @break
                                        @case('Expired')
                                            <span class="badge bg-danger">Kadaluarsa</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">Tidak Tersedia</span>
                                    @endswitch
                                </td>
                                <td class="aksi-col">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <a href="{{ route('admin.sertifikat.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.sertifikat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end my-4">
                {{ $sertifikats->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection