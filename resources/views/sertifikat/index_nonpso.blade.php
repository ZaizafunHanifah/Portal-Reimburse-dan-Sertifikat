@extends('layouts.app')
@section('title', 'Portal Sertifikat Non PSO')

@section('content')
<h2 class="mb-3">Portal Sertifikat Non PSO</h2>

<div class="row mb-4">
    <div class="col-12 col-md-6 col-lg-5 col-xl-4">
        <form action="{{ route('portal.nonpso') }}" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{ old('nik', request('nik')) }}" required>
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>
    </div>
</div>

@if(request('nik'))
    @if(empty($pelaut) || !$pelaut)
        <div class="alert alert-warning">
            Data Non-PSO dengan NIK <strong>{{ e(request('nik')) }}</strong> tidak ditemukan.
        </div>
    @else
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div>Kapal : {{ e($pelaut->kapal ?? '-') }}</div>
                        <div>Pemilik : {{ e($pelaut->pemilik ?? '-') }}</div>
                        <div>NIK : {{ e($pelaut->nik ?? request('nik')) }}</div>
                        <div>Nama : {{ e($pelaut->nama ?? '-') }}</div>
                        <div>Jabatan : {{ e($pelaut->jabatan ?? '-') }}</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div>Bendera : {{ e($pelaut->bendera ?? 'Indonesia') }}</div>
                        <div>Tipe : {{ e($pelaut->tipe ?? '-') }}</div>
                        <div>No KTP : {{ e($pelaut->no_ktp ?? '-') }}</div>
                        <div>Pelabuhan : {{ e($pelaut->pelabuhan ?? '-') }}</div>
                        <div>Kelompok : {{ e($pelaut->kelompok ?? '-') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL SERTIFIKAT WAJIB SESUAI JABATAN --}}
        @if(isset($sertifikatWajib) && count($sertifikatWajib) > 0)
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Jenis Sertifikat</th>
                                <th>Nomor Sertifikat</th>
                                <th>Terbit</th>
                                <th>Expired</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sertifikatWajib as $jenis)
                                @php
                                    $data = $sertifikat->firstWhere('jenis_sertifikat', $jenis);
                                    $expiredDate = $data && $data->expired ? \Carbon\Carbon::parse($data->expired) : null;
                                    $now = \Carbon\Carbon::now();
                                    $status = 'Tidak Tersedia';

                                    if ($expiredDate) {
                                        if ($expiredDate->isPast()) {
                                            $status = 'Kadaluarsa';
                                        } else {
                                            $diffInMonths = $now->diffInMonths($expiredDate, false);
                                            $diffInDays = $now->diffInDays($expiredDate, false);
                                            if ($diffInMonths < 3 && $diffInDays >= 0) {
                                                $status = 'Akan Kadaluarsa';
                                            } else {
                                                $status = 'Aktif';
                                            }
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $jenis }}</td>
                                    <td>{{ $data->nomor_sertifikat ?? '-' }}</td>
                                    <td>{{ $data && $data->terbit ? \Carbon\Carbon::parse($data->terbit)->format('d M Y') : '-' }}</td>
                                    <td>{{ $data && $data->expired ? \Carbon\Carbon::parse($data->expired)->format('d M Y') : '-' }}</td>
                                    <td>
                                        @if($status == 'Kadaluarsa')
                                            <span class="badge rounded-pill" style="background:#f00;color:#fff;padding:4px 10px;font-size:0.85em;">Kadaluarsa</span>
                                        @elseif($status == 'Akan Kadaluarsa')
                                            <span class="badge rounded-pill" style="background:#ff9800;color:#fff;padding:4px 10px;font-size:0.85em;">Akan Kadaluarsa</span>
                                        @elseif($status == 'Aktif')
                                            <span class="badge rounded-pill" style="background:#41e86b;color:#222;padding:4px 10px;font-size:0.85em;">Aktif</span>
                                        @else
                                            <span class="badge rounded-pill" style="background:#aaa;color:#222;padding:4px 10px;font-size:0.85em;">Tidak Tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    @endif
@else
    <div class="alert alert-info">
        Masukkan NIK untuk melihat data sertifikat.
    </div>
@endif
@endsection