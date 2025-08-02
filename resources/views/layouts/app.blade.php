<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        html, body {
            min-height: 100vh;
            height: 100%;
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at top right, #e0e7ff, #f9fafb);
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid #333;
        }
        .main-content {
            flex: 1 0 auto;
            padding-bottom: 40px;
        }
        .navbar {
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        .navbar-nav {
            flex-direction: row !important;
            overflow-x: auto;
            white-space: nowrap;
            gap: 1.25rem;
        }
        .navbar-nav .nav-item {
            flex: 0 0 auto;
        }
        .navbar-brand {
            margin-right: 2.5rem !important;
        }
        .navbar-toggler {
            display: none !important;
        }
        .navbar-collapse {
            display: flex !important;
            flex-basis: auto;
        }
        @media (max-width: 991.98px) {
            .navbar-nav {
                padding-bottom: 4px;
            }
            .navbar-brand {
                margin-right: 1.25rem !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
{{-- 
    Jika view mewarisi section('dashboard-navbar'), maka tampilkan navbar dashboard (admin).
    Jika tidak, tampilkan navbar portal (publik).
    Pastikan setiap view admin menambahkan: @section('dashboard-navbar') @endsection
--}}
@if(View::hasSection('dashboard-navbar'))
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard Reimburse</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.sertifikat.dashboard') }}" class="nav-link {{ request()->routeIs('admin.sertifikat.dashboard') ? 'active' : '' }}">Dashboard Sertifikat PSO</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.nonpso.dashboard') }}" class="nav-link {{ request()->routeIs('admin.nonpso.dashboard') ? 'active' : '' }}">Dashboard Sertifikat Non PSO</a>
                </li>
                <!-- Link Pegawai untuk dashboard/admin -->
                <li class="nav-item">
                    <a href="{{ route('admin.pegawai.index') }}" class="nav-link {{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">Pegawai</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@else
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Portal</a>
        <div class="navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ url()->current() == url('/') ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/reimburse') }}" class="nav-link {{ request()->is('reimburse') ? 'active' : '' }}">Portal Reimburse</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/sertifikat') }}" class="nav-link {{ request()->is('sertifikat') ? 'active' : '' }}">Portal Sertifikat PSO</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/sertifikat-nonpso') }}" class="nav-link {{ request()->is('sertifikat-nonpso') ? 'active' : '' }}">Portal Sertifikat Non PSO</a>
                </li>
                <!-- Link Pegawai untuk portal/publik -->
                <li class="nav-item">
                    <a href="{{ route('admin.pegawai.index') }}" class="nav-link {{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">Pegawai</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endif
<div class="container main-content">
    @yield('content')
</div>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>