@extends('layouts.app-nonav')

@section('title', 'Edit Sertifikat PSO')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-create-form.css') }}">

<div class="row justify-content-center mt-5">
    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
        <div class="card admin-create-card">
            <div class="card-body">
                <h2 class="mb-4">Edit Sertifikat PSO</h2>
                <form id="editPsoForm" method="POST" action="{{ route('admin.sertifikat.update', $sertifikat->id) }}" class="admin-create-form">
                    @csrf
                    @method('PUT')

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
                            'pelabuhan' => 'Pelabuhan',
                            'jenis_sertifikat' => 'Jenis Sertifikat',
                            'nomor_sertifikat' => 'Nomor Sertifikat',
                            'tanggal_pengajuan' => 'Tanggal Pengajuan',
                            'terbit' => 'Tanggal Terbit Sertifikat',
                            'expired' => 'Tanggal Kadaluarsa Sertifikat',
                        ];

                        $dateFields = ['tanggal_pengajuan', 'terbit', 'expired'];
                    @endphp

                    <div class="row">
                        @foreach ($fields as $key => $label)
                            <div class="col-12 col-md-6 mb-3">
                                <label>{{ $label }}</label>
                                <input 
                                    type="{{ in_array($key, $dateFields) ? 'date' : 'text' }}" 
                                    name="{{ $key }}" 
                                    value="{{ old($key, $sertifikat->$key ? (in_array($key, $dateFields) ? \Carbon\Carbon::parse($sertifikat->$key)->format('Y-m-d') : $sertifikat->$key) : '') }}" 
                                    class="form-control"
                                >
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary w-50">
                            Update Data
                        </button>
                        <button type="button" id="tambahBaruBtn" class="btn btn-success w-50">
                            Tambah Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('tambahBaruBtn').addEventListener('click', function(e) {
    var form = document.getElementById('editPsoForm');
    form.action = "{{ route('admin.sertifikat.store') }}";
    // Remove method spoofing if exists
    var methodInput = form.querySelector('input[name="_method"]');
    if(methodInput) methodInput.parentNode.removeChild(methodInput);
    form.submit();
});
</script>
@endsection