@extends('layouts.app')
@section('title', 'Home')

@section('content')

<style>
    body {
        /* Ensure body takes full viewport and no scrollbars */
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    .hero-bg {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100vw;
        height: 100vh;
        background: radial-gradient(circle at top right, #e0e7ff, #f9fafb);
        z-index: -1;
    }
    .hero-content {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
</style>
<div class="hero-bg"></div>
<div class="container hero-content py-5">
    <div class="row justify-content-start">
        <div class="col-md-6">
            <p class="text-muted mb-1 fw-medium">Selamat Datang di</p>
            <h1 class="fw-bold display-5 mb-3">Portal Sertifikat<br>& Reimburse</h1>
            <p class="text-secondary mb-4" style="max-width: 900px;">
                Portal ini digunakan untuk memantau status pengajuan reimburse serta masa berlaku sertifikat pelaut.
                Silakan gunakan menu untuk melihat data, melakukan pencarian pengajuan secara mudah dan cepat.
            </p>
            <div class="d-flex gap-3">
                <a href="{{ url('/reimburse') }}" class="btn btn-dark px-4 rounded-pill">Lihat Data Reimburse</a>
                <a href="{{ url('/sertifikat') }}" class="btn btn-outline-dark px-4 rounded-pill">Lihat Data Sertifikat</a>
            </div>
        </div>
    </div>
</div>
@endsection