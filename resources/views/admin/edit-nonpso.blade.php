@extends('layouts.app-nonav')

@section('title', isset($sertifikat) ? 'Edit Sertifikat Non-PSO' : 'Tambah Sertifikat Non-PSO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-create-form.css') }}">
@endpush

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
        <div class="card admin-create-card">
            <div class="card-body">
                <h2 class="mb-4 fw-bold text-center">
                    {{ isset($sertifikat) ? 'Edit Sertifikat Non-PSO' : 'Tambah Sertifikat Non-PSO' }}
                </h2>
                <form id="nonpsoForm"
                      method="POST"
                      action="{{ isset($sertifikat) ? route('admin.nonpso.update', $sertifikat->id) : route('admin.nonpso.store') }}"
                      class="admin-create-form">
                    @csrf
                    @if(isset($sertifikat))
                        @method('PUT')
                    @endif

                    @php
                        $fields = [
                            'nama' => 'Nama',
                            'nik' => 'NIK',
                            'jabatan' => 'Jabatan',
                            'kapal' => 'Kapal',
                            'pemilik' => 'Pemilik',
                            'kelompok' => 'Kelompok',
                            'no_ktp' => 'No KTP',
                            'bendera' => 'Bendera',
                            'tipe' => 'Tipe',
                            'pelabuhan' => 'Pelabuhan',
                            'jenis_sertifikat' => 'Jenis Sertifikat',
                            'nomor_sertifikat' => 'Nomor Sertifikat',
                            'terbit' => 'Tanggal Terbit Sertifikat',
                            'expired' => 'Tanggal Kadaluarsa Sertifikat',
                            'tanggal_pengajuan' => 'Tanggal Pengajuan',
                        ];
                        $dateFields = ['terbit', 'expired', 'tanggal_pengajuan'];
                    @endphp

                    <div class="row">
                        @foreach ($fields as $key => $label)
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label fw-semibold">{{ $label }}</label>
                                <input
                                    type="{{ in_array($key, $dateFields) ? 'date' : 'text' }}"
                                    name="{{ $key }}"
                                    value="{{ old($key, isset($sertifikat) && $sertifikat->$key ? (in_array($key, $dateFields) ? \Carbon\Carbon::parse($sertifikat->$key)->format('Y-m-d') : $sertifikat->$key) : '') }}"
                                    class="form-control"
                                >
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary w-50">
                            {{ isset($sertifikat) ? 'Update' : 'Simpan' }}
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
    var form = document.getElementById('nonpsoForm');
    form.action = "{{ route('admin.nonpso.store') }}";
    // Remove method spoofing if exists
    var methodInput = form.querySelector('input[name="_method"]');
    if(methodInput) methodInput.parentNode.removeChild(methodInput);
    form.submit();
});
</script>
@endif
@endsection