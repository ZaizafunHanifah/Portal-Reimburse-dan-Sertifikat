<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            min-height: 100vh;
            height: 100%;
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at top right, #e0e7ff, #f9fafb);
        }
        body {
            /* fallback for browsers that don't support min-height on html */
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
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Portal</a>
        <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item"><a href="{{ url('/reimburse') }}" class="nav-link {{ Request::is('reimburse*') ? 'active' : '' }}">Portal Reimburse</a></li>
                <li class="nav-item"><a href="{{ url('/sertifikat') }}" class="nav-link {{ Request::is('sertifikat*') ? 'active' : '' }}">Portal Sertifikat</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container main-content">
    @yield('content')
</div>
@stack('scripts')
</body>
</html>