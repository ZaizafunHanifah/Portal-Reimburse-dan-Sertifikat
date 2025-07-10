@extends('layouts.app')
@section('title', 'Tambah Data')
@section('content')
<h2>Tambah Data Reimburse</h2>
<form method="post" action="{{ url('/admin') }}">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>NRP</label>
            <input type="text" name="nrp" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Jenis Sertifikat</label>
            <input type="text" name="jenis_sertifikat" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>No Sertifikat</label>
            <input type="text" name="no_sertifikat" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Tanggal Pengajuan</label>
            <input type="date" name="tanggal_pengajuan" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="On Review" selected>On Review</option>
                <option value="Diajukan ke LND">Diajukan ke LND</option>
                <option value="Diajukan ke Akuntansi">Diajukan ke Akuntansi</option>
                <option value="Diajukan ke Treasury">Diajukan ke Treasury</option>
                <option value="Cleared">Cleared</option>
            </select>
        </div>
    </div>
    <button class="btn btn-success">Simpan</button>
</form>
@endsection