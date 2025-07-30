@extends('layouts.app-nonav')

@section('title', 'Tambah Sertifikat PSO')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 fw-bold text-center">Tambah Sertifikat PSO</h2>
                <form method="post" action="{{ route('admin.sertifikat.store') }}">
                    @csrf
                    <!-- Tambahkan hidden input agar source selalu 'pso' -->
                    <input type="hidden" name="source" value="pso">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">NRP</label>
                            <input type="text" name="nrp" class="form-control" value="{{ old('nrp') }}" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-select" required>
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach([
                                    'NAKHODA', 'MUALIM I', 'MUALIM II Sr & Yr', 'MUALIM III Sr & Yr', 'MUALIM IV',
                                    'DOKTER', 'PERAWAT', 'PUK', 'SERANG', 'TANDIL', 'PANJARWALA', 'MISTRI',
                                    'KELASI', 'KASAP DEK', 'JURU MUDI', 'KKM', 'MASINIS I Sr', 'MASINIS I Yr',
                                    'MASINIS II', 'MASINIS III', 'MASINIS IV', 'JENANG',
                                    'PERAKIT MASAK & JURU MASAK', 'KEPALA PELAYAN', 'PELAYAN ATAU PENATU',
                                    'PERWIRA RADIO', 'ITTO', 'AHLI LISTRIK'
                                ] as $jabatan)
                                    <option value="{{ $jabatan }}" {{ old('jabatan') == $jabatan ? 'selected' : '' }}>{{ $jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Kapal</label>
                            <input type="text" name="kapal" class="form-control" value="{{ old('kapal') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Pemilik</label>
                            <input type="text" name="pemilik" class="form-control" value="{{ old('pemilik') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Kelompok</label>
                            <input type="text" name="kelompok" class="form-control" value="{{ old('kelompok') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">No KTP</label>
                            <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Bendera</label>
                            <input type="text" name="bendera" class="form-control" value="{{ old('bendera', 'Indonesia') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Tipe</label>
                            <input type="text" name="tipe" class="form-control" value="{{ old('tipe') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Pelabuhan</label>
                            <input type="text" name="pelabuhan" class="form-control" value="{{ old('pelabuhan') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Jenis Sertifikat</label>
                            <input type="text" name="jenis_sertifikat" class="form-control" value="{{ old('jenis_sertifikat') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Nomor Sertifikat</label>
                            <input type="text" name="nomor_sertifikat" class="form-control" value="{{ old('nomor_sertifikat') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ old('tanggal_pengajuan') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Tanggal Terbit Sertifikat</label>
                            <input type="date" name="terbit" class="form-control" value="{{ old('terbit') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Tanggal Kadaluarsa Sertifikat</label>
                            <input type="date" name="expired" class="form-control" value="{{ old('expired') }}">
                        </div>
                    </div>
                    <button class="btn btn-success w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection