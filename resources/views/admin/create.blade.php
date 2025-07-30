@extends('layouts.app-nonav')

@section('title', 'Tambah Data')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4">Tambah Data Reimburse</h2>
                <form method="post" action="{{ url('/admin') }}">
                    @csrf
                    <!-- Hidden input agar data selalu bertipe reimburse -->
                    <input type="hidden" name="source" value="reimburse">
                    <div class="row">
                        {{-- Data Umum --}}
                        <div class="col-12 mb-3">
                            <h5>Data Umum</h5>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>NRP</label>
                            <input type="text" name="nrp" class="form-control" value="{{ old('nrp') }}" required>
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
                            <label>Jabatan</label>
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
                            <label>Bendera</label>
                            <input type="text" name="bendera" class="form-control" value="{{ old('bendera', 'Indonesia') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Tipe</label>
                            <input type="text" name="tipe" class="form-control" value="{{ old('tipe') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>No KTP</label>
                            <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Pelabuhan</label>
                            <input type="text" name="pelabuhan" class="form-control" value="{{ old('pelabuhan') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Kelompok</label>
                            <input type="text" name="kelompok" class="form-control" value="{{ old('kelompok') }}">
                        </div>

                        {{-- Data Sertifikat --}}
                        <div class="col-12 mt-4 mb-2">
                            <h5>Data Sertifikat</h5>
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
                            <label>Tanggal Terbit Sertifikat</label>
                            <input type="date" name="terbit" class="form-control" value="{{ old('terbit') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Tanggal Kadaluarsa Sertifikat</label>
                            <input type="date" name="expired" class="form-control" value="{{ old('expired') }}">
                        </div>

                        {{-- Data Reimburse --}}
                        <div class="col-12 mt-4 mb-2">
                            <h5>Data Reimburse</h5>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Tanggal Pengajuan</label>
                            <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ old('tanggal_pengajuan') }}">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label>Status Progres Reimburse</label>
                            <select name="status_progres_reimburse" class="form-control">
                                <option value="">-- Pilih Status Progres --</option>
                                @foreach([
                                    'On Review', 'Diajukan ke LND', 'Diajukan ke Akuntansi',
                                    'Diajukan ke Treasury', 'Cleared'
                                ] as $status)
                                    <option value="{{ $status }}" {{ old('status_progres_reimburse') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection