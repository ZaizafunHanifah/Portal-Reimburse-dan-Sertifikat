@extends('layouts.app-nonav')

@section('title', isset($sertifikat) ? 'Edit Data' : 'Tambah Data')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-create-form.css') }}">

<div class="row justify-content-center mt-5">
    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
        <div class="card admin-create-card">
            <div class="card-body">
                <h2 class="mb-4">
                    {{ isset($sertifikat) ? 'Edit Data Sertifikat dan Reimburse' : 'Tambah Data Sertifikat dan Reimburse' }}
                </h2>

                <form 
                    id="sertifikatForm"
                    method="post" 
                    action="{{ isset($sertifikat) ? route('admin.update', $sertifikat->id) : route('admin.store') }}" 
                    class="admin-create-form"
                >
                    @csrf
                    @if(isset($sertifikat))
                        @method('PUT')
                    @endif

                    @php
                        $fields = [
                            'nama' => 'Nama',
                            'nrp' => 'NRP',
                            'jabatan' => 'Jabatan',
                            'kapal' => 'Kapal',
                            'pemilik' => 'Pemilik',
                            'kelompok' => 'Kelompok',
                            'no_ktp' => 'No KTP',
                            'bendera' => 'Bendera',
                            'tipe' => 'Tipe',
                            'pelabuhan' => 'Pelabuhan', // DITAMBAHKAN DI SINI
                            'jenis_sertifikat' => 'Jenis Sertifikat',
                            'nomor_sertifikat' => 'Nomor Sertifikat',
                            'terbit' => 'Tanggal Terbit Sertifikat',
                            'expired' => 'Tanggal Kadaluarsa Sertifikat',
                            'tanggal_pengajuan' => 'Tanggal Pengajuan',
                            'on_review_date' => 'Tanggal On Review',
                            'lnd_date' => 'Tanggal Diajukan ke LND',
                            'akuntansi_date' => 'Tanggal Diajukan ke Akuntansi',
                            'treasury_date' => 'Tanggal Diajukan ke Treasury',
                            'cleared_date' => 'Tanggal Cleared',
                        ];

                        $dateFields = [
                            'terbit',
                            'expired',
                            'tanggal_pengajuan',
                            'on_review_date',
                            'lnd_date',
                            'akuntansi_date',
                            'treasury_date',
                            'cleared_date'
                        ];
                    @endphp

                    <div class="row">
                        @foreach ($fields as $key => $label)
                            <div class="col-12 col-md-6 mb-3">
                                <label>{{ $label }}</label>
                                <input 
                                    type="{{ in_array($key, $dateFields) ? 'date' : 'text' }}" 
                                    name="{{ $key }}" 
                                    value="{{ old($key, isset($sertifikat) && $sertifikat->$key ? ($dateFields && in_array($key, $dateFields) ? \Carbon\Carbon::parse($sertifikat->$key)->format('Y-m-d') : $sertifikat->$key) : '') }}" 
                                    class="form-control"
                                >
                            </div>
                        @endforeach

                        <div class="col-12 col-md-6 mb-3">
                            <label>Status Progres Reimburse</label>
                            <select name="status_progres_reimburse" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                @foreach(['On Review', 'Diajukan ke LND', 'Diajukan ke Akuntansi', 'Diajukan ke Treasury', 'Cleared'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_progres_reimburse', $sertifikat->status_progres_reimburse ?? '') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-50">
                            {{ isset($sertifikat) ? 'Update Data' : 'Simpan Data' }}
                        </button>
                        @if(isset($sertifikat))
                        <button type="button" id="tambahBaruBtn" class="btn btn-success w-50">
                            Tambah Baru
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(isset($sertifikat))
<script>
document.getElementById('tambahBaruBtn').addEventListener('click', function(e) {
    var form = document.getElementById('sertifikatForm');
    form.action = "{{ route('admin.store') }}";
    // Remove method spoofing if exists
    var methodInput = form.querySelector('input[name="_method"]');
    if(methodInput) methodInput.parentNode.removeChild(methodInput);
    form.submit();
});
</script>
@endif
@endsection