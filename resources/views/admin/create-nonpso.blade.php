@extends('layouts.app-nonav')

@section('title', 'Tambah Sertifikat Non-PSO')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Tambah Sertifikat Non-PSO</h2>
                    <form method="POST" action="{{ route('admin.nonpso.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Kapal</label>
                                <input type="text" name="kapal" class="form-control" value="{{ old('kapal') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Pemilik</label>
                                <input type="text" name="pemilik" class="form-control" value="{{ old('pemilik') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Kelompok</label>
                                <input type="text" name="kelompok" class="form-control" value="{{ old('kelompok') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>No KTP</label>
                                <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Jenis Sertifikat</label>
                                <input type="text" name="jenis_sertifikat" class="form-control" value="{{ old('jenis_sertifikat') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Nomor Sertifikat</label>
                                <input type="text" name="nomor_sertifikat" class="form-control" value="{{ old('nomor_sertifikat') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Tanggal Pengajuan</label>
                                <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ old('tanggal_pengajuan') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Tanggal Terbit</label>
                                <input type="date" name="terbit" class="form-control" value="{{ old('terbit') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Tanggal Expired</label>
                                <input type="date" name="expired" class="form-control" value="{{ old('expired') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Bendera</label>
                                <input type="text" name="bendera" class="form-control" value="{{ old('bendera') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Tipe</label>
                                <input type="text" name="tipe" class="form-control" value="{{ old('tipe') }}">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label>Pelabuhan</label>
                                <input type="text" name="pelabuhan" class="form-control" value="{{ old('pelabuhan') }}">
                            </div>
                        </div>
                        <button class="btn btn-success w-100 mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection