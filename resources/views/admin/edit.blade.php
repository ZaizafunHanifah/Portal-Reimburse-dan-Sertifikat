@extends('layouts.app')
@section('title', 'Edit Data')
@section('content')
<h2>Edit Data Reimburse</h2>
<form method="post" action="{{ url('/admin/'.$reimburse->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $reimburse->nama }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>NRP</label>
            <input type="text" name="nrp" value="{{ $reimburse->nrp }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" value="{{ $reimburse->jabatan }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Jenis Sertifikat</label>
            <input type="text" name="jenis_sertifikat" value="{{ $reimburse->jenis_sertifikat }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>No Sertifikat</label>
            <input type="text" name="no_sertifikat" value="{{ $reimburse->no_sertifikat }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Tanggal Pengajuan</label>
            <input type="date" name="tanggal_pengajuan" value="{{ $reimburse->tanggal_pengajuan }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="On Review" {{ $reimburse->status == 'On Review' ? 'selected' : '' }}>On Review</option>
                <option value="Diajukan ke LND" {{ $reimburse->status == 'Diajukan ke LND' ? 'selected' : '' }}>Diajukan ke LND</option>
                <option value="Diajukan ke Akuntansi" {{ $reimburse->status == 'Diajukan ke Akuntansi' ? 'selected' : '' }}>Diajukan ke Akuntansi</option>
                <option value="Diajukan ke Treasury" {{ $reimburse->status == 'Diajukan ke Treasury' ? 'selected' : '' }}>Diajukan ke Treasury</option>
                <option value="Cleared" {{ $reimburse->status == 'Cleared' ? 'selected' : '' }}>Cleared</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label>Tanggal On Review</label>
            <input type="date" name="on_review_date" value="{{ $reimburse->on_review_date }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Tanggal Diajukan ke LND</label>
            <input type="date" name="lnd_date" value="{{ $reimburse->lnd_date }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Tanggal Diajukan ke Akuntansi</label>
            <input type="date" name="akuntansi_date" value="{{ $reimburse->akuntansi_date }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Tanggal Diajukan ke Treasury</label>
            <input type="date" name="treasury_date" value="{{ $reimburse->treasury_date }}" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Tanggal Cleared</label>
            <input type="date" name="cleared_date" value="{{ $reimburse->cleared_date }}" class="form-control">
        </div>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection