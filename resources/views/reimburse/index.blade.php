{{-- Progress Bar dengan Tanggal Selesai per Step --}}
@extends('layouts.app')
@section('title', 'Portal Reimburse')
@section('content')
<h2 class="mb-3">Cari Data Reimburse</h2>
<div class="row mb-4">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <form action="{{ url('/reimburse') }}" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="no_sertifikat" class="form-control" placeholder="Masukkan No Sertifikat">
                <button class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>
</div>

@if(isset($data))
<div class="card mb-3">
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $data->nama }}</p>
        <p><strong>NRP:</strong> {{ $data->nrp }}</p>
        <p><strong>Jabatan:</strong> {{ $data->jabatan }}</p>
        <p><strong>Jenis Sertifikat:</strong> {{ $data->jenis_sertifikat }}</p>
        <p><strong>No Sertifikat:</strong> {{ $data->no_sertifikat }}</p>
        <p><strong>Tanggal Pengajuan:</strong> {{ $data->tanggal_pengajuan }}</p>
    </div>
</div>

@php
    $steps = [
        'On Review' => $data->on_review_date ?? null,
        'Diajukan ke LND' => $data->lnd_date ?? null,
        'Diajukan ke Akuntansi' => $data->akuntansi_date ?? null,
        'Diajukan ke Treasury' => $data->treasury_date ?? null,
        'Cleared' => $data->cleared_date ?? null,
    ];
    $stepKeys = array_keys($steps);
    $currentIndex = array_search($data->status, $stepKeys);
    
    if ($currentIndex === false) $currentIndex = 0;
@endphp

<div class="bg-light rounded p-3 mb-4 shadow-sm">
    <h4 class="fw-bold mb-3">Progress</h4>
    <div class="d-flex justify-content-between text-center">
        @foreach ($steps as $step => $date)
            @php
                $index = array_search($step, $stepKeys);
                if ($index < $currentIndex) {
                    $statusClass = 'bg-success text-white';
                    $circleContent = '<i class="bi bi-check-lg"></i>';
                } elseif ($index === $currentIndex) {
                    $statusClass = 'bg-warning text-dark';
                    $circleContent = '<div class="spinner-border spinner-border-sm" role="status"></div>';
                } else {
                    $statusClass = 'bg-secondary text-white';
                    $circleContent = $index + 1;
                }
                
                $formattedDate = '-';
                if ($index < $currentIndex && !empty($date) && $date !== '0000-00-00') {
                    try {
                        $formattedDate = \Carbon\Carbon::parse($date)->format('d F Y');
                    } catch (\Exception $e) {
                        $formattedDate = '-';
                    }
                }
            @endphp
            <div class="flex-fill px-2">
                <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ $statusClass }}" style="width: 40px; height: 40px;">
                    {!! $circleContent !!}
                </div>
                <div class="fw-semibold small">{{ $step }}</div>
                <div class="text-muted small">
                    {{ $formattedDate }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection